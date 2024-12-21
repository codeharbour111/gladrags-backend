<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Categories;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductWithIdResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    public function index()
    {
        $products =  Product::with('category', 'images', 'inventory')->paginate(10);

        return view('pages.products.all-products',compact('products'));
    }

    public function addProduct()
    {
        $categories = Categories::all();

        return view('pages.products.add-new-product',compact('categories'));
    }

    public function editProduct(Request $request)
    {
        $product = Product::with('category', 'images', 'inventory')->find($request->id);
        $categories = Categories::all();

        $quantities = DB::table('inventory')
            ->select('size', DB::raw('count(*) as quantity'))
            ->where('product_id', $request->id)
            ->groupBy('size')
            ->pluck('quantity', 'size');

        return view('pages.products.update-product', compact('product', 'categories', 'quantities'));
    }
    
    public function loadLatestProduct()
    {
        // Load the latest product based on created time
        $latestProduct = Product::with(['category', 'images'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Load products marked as best_seller
        $bestSellers = Product::with(['category', 'images'])
            ->where('best_seller', 1)
            ->get();

        if ($latestProduct != null) {
            return response()->json([
                'status' => 'success',
                'latest_product' => ProductResource::collection($latestProduct),
                'best_sellers' =>  ProductResource::collection($bestSellers)
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No products found.'
            ], 201);
        }
    }

    public function load()
    {
        return new ProductCollection(Product::with('category','images')->paginate(10));
    }

    public function loadProduct(Request $request)
    {

        $result = Product::with(['category','images'])->where('id',$request->id)->first();
     
        if($result != null)
            return new ProductWithIdResource(Product::with(['category','images'])->where('id',$request->id)->first());
        else
            return response()->json(
                [
                    'status'  => 'error',
                    'message' =>  'Product does not exists.'
                ],201);
    }
    
    public function store(Request $request)
    {
        $request->validate
        ([
            'name'=>'required',
            'category_id'=>'required',
            'description'=>'required',
            'price'=>'required',
            'product_images'=>'required',
            'color'=>'required'
        ]);

        try
        {
            $product = new Product();

            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->has_discount = $request->has_discount;
            $product->discount_price = $request->discount_price;
            $product->discount_date = $request->discount_date;
           
            $product->save();

            foreach($request->product_images as $product_image)
            {
                $images = new ProductImage();

                $images->product_id = $product->id;

                $file = $product_image;
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;

                try
                {
                    //$filename = $product_image->store("product");
                    $filename = Storage::disk('public')->putFile('product', $product_image, 'public');
                }
                catch(FileException $e)
                {

                }

                $images->image_path = $filename;

                $images->save();
            }

            $size = $request->size;

            if($size)
            {
                $inventories = Inventory::where('product_id',$product->id)
                             ->where('size',$size);

                if($inventories)
                {
                    $inventories->delete();
                }
            }

            for ($i = 0; $i < $request->quantity; $i++)
            {
                $inventory = new Inventory();

                $inventory->product_id = $product->id;
                $inventory->size = $request->size;

                $inventory->save();
            }

            return response()->json('Product added',201);
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function update(Request $request,$id)
    {
        $request->validate
        ([
            'name'=>'required',
            'category_id'=>'required',
            'description'=>'required',
            'price'=>'required',
            //'product_images'=>'required',
            'color'=>'required'
        ]);

        $product = Product::findOrFail($id);

        try
        {
          
            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->has_discount = $request->has_discount;
            $product->discount_price = $request->discount_price;
            $product->discount_date = $request->discount_date;
            $product->best_seller = $request->best_seller;
            $product->color = $request->color;
            $product->sku = $request->sku;

            $inventories = Inventory::where('product_id',$product->id);

            if($inventories)
            {
                $inventories->delete();
            }

            $quantities = $request->input('quantities', []);

            foreach ($quantities as $size => $quantity)
            {
                for ($i = 0; $i < $quantity; $i++)
                {
                    $inventory = new Inventory();

                    $inventory->product_id = $product->id;
                    $inventory->category_id = $product->category_id;
                    $inventory->size = $size;

                    $inventory->save();
                }
            }
           
            $product->save();

            if($request->product_images)
            {
                foreach($request->product_images as $product_image)
                {
                    $images = new ProductImage();
    
                    $images->product_id = $product->id;
    
                    $file = $product_image;
                    $ext = $file->getClientOriginalExtension();
                    $filename = time().'.'.$ext;
    
                    try
                    {
                        //$filename = $product_image->store("product");
                        $filename = Storage::disk('public')->putFile('product', $product_image, 'public');
                    }
                    catch(FileException $e)
                    {
    
                    }
    
                    $images->image_path = $filename;
    
                    $images->save();
                }
            }
          
           return redirect()->route('all.products')->with('success', 'Product updated successfully.');
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('all.products')->with('success', 'Product deleted successfully.');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
             'name'=>'required',
             'category_id'=>'required',
             'description'=>'required',
             'price'=>'required',
             'product_images'=>'required',
            // 'color'=>'required',
        ]);

        try
        {
            $product = new Product();

            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->has_discount = $request->has_discount;
            $product->discount_price = $request->discount_price;
            $product->discount_date = $request->discount_date;
            $product->color = $request->color;
            $product->sku = $request->sku;
            $product->best_seller = $request->best_seller;

            $product->save();

            $images = $request->file('product_images') ?? []; 
            
            // Default to an empty
            // dd($request->all(), $request->file('product_images'));
            // dd($request->product_images); // Dumps the input and stops execution

            foreach($request->product_images as $product_image)
            {
                $images = new ProductImage();

                $images->product_id = $product->id;

                $file = $product_image;
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;

                try
                {
                    //$filename = $product_image->store("product");
                    $filename = Storage::disk('public')->putFile('product', $product_image, 'public');
                }
                catch(FileException $e)
                {

                }

                $images->image_path = $filename;

                $images->save();
            }

            // $size = $request->size;

            // if($size)
            // {
            //     $inventories = Inventory::where('product_id',$product->id)
            //                  ->where('size',$size);

            //     if($inventories)
            //     {
            //         $inventories->delete();
            //     }
            // }

           
            // $index = array();

            // for ($i = 0; $i < $request->quantity; $i++)
            // {
            //     $inventory = new Inventory();

            //     $inventory->product_id = $product->id;
            //     $inventory->size = $request->size;

            //     $inventory->save();
            //     $index[] = $i;
                
            // }

            $inventories = Inventory::where('product_id',$product->id);

            if($inventories)
            {
                $inventories->delete();
            }

            $quantities = $request->input('quantities', []);

            foreach ($quantities as $size => $quantity)
            {
                for ($i = 0; $i < $quantity; $i++)
                {
                    $inventory = new Inventory();

                    $inventory->product_id = $product->id;
                    $inventory->category_id = $product->category_id;
                    $inventory->size = $size;

                    $inventory->save();
                }
            }

           // dd($index);
           // dd($e);
            // return response()->json('Product added',201);
            return redirect()->back()->with('success', 'Product saved successfully.');

        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }


    public function storeImages(Request $request)
    {
        // Validate the uploaded images
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Array to store file paths
        $uploadedFiles = [];

        // Process each uploaded image
        foreach ($request->file('images') as $file) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads', $fileName, 'public');
            $uploadedFiles[] = $path;
        }

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Images uploaded and saved successfully',
            'files' => $uploadedFiles,
        ]);
    }



}
