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
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    public function index()
    {
        $products =  Product::with(['category', 'images' => function($query) {
                            $query->orderBy('sort_index');
                        }, 'inventory'])->paginate(10);

        return view('pages.products.product-list',compact('products'));
    }

    public function addProduct()
    {
        $categories = Categories::all();

        return view('pages.products.add-new-product',compact('categories'));
    }

    public function editProduct(Request $request)
    {
        $product = Product::with(['category', 'images' => function($query) {
                            $query->orderBy('sort_index');
                        }, 'inventory'])->find($request->id);
        $categories = Categories::all();

        $quantities = DB::table('inventory')
            ->select('size', DB::raw('count(*) as quantity'))
            ->where('product_id', $request->id)
            ->groupBy('size')
            ->pluck('quantity', 'size');

        return view('pages.products.update-product', compact('product', 'categories', 'quantities'));
    }

    public function sortImages(Request $request)
    {
        $product = Product::with(['category', 'images' => function($query) {
                            $query->orderBy('sort_index');
                        }, 'inventory'])->find($request->id);
        $categories = Categories::all();

        $quantities = DB::table('inventory')
            ->select('size', DB::raw('count(*) as quantity'))
            ->where('product_id', $request->id)
            ->groupBy('size')
            ->pluck('quantity', 'size');

        return view('pages.products.sort-images', compact('product', 'categories', 'quantities'));
    }
    
    public function sort(Request $request)
    {
        $sortedItems = $request->input('sortedItems');

        // Update the order of images in the database
        foreach ($sortedItems as $index => $imageId) {
            $image = ProductImage::find($imageId);
            if ($image) {
                $image->sort_index = $index;
                $image->save();
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Images sorted successfully']);
    }

    public function loadProducts(Request $request)
    {
        $productIds = $request->input('product_ids', []);

        if (empty($productIds)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'No product IDs provided.'
            ], 400);
        }

        $products = Product::with(['category', 'images' => function($query) {
                            $query->orderBy('sort_index');
                        }])
            ->whereIn('id', $productIds)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => ProductResource::collection($products)
        ], 200);
    }

    public function filterProducts(Request $request)
    {
        $query = Product::with(['category', 'images' => function($query) {
                            $query->orderBy('sort_index');
                        }]);

        // Filter by category
        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Filter by size
        if ($request->has('size')) {
            $size = $request->input('size');
            $query->whereHas('inventory', function ($q) use ($size) {
                $q->where('size', $size);
            });
        }

        // Sort by date
        if ($request->has('sort_by_date')) {
            $sortOrder = $request->input('sort_by_date') == 'asc' ? 'asc' : 'desc';
            $query->orderBy('created_at', $sortOrder);
        }

        $products = $query->paginate(10); // Adjust pagination as needed

        return response()->json([
            'status' => 'success',
            'data' => ProductWithIdResource::collection($products)
        ], 200);
    }

    public function loadLatestProduct()
    {
        // Load the latest product based on created time
        $latestProduct = Product::with(['category', 'images' => function($query) {
                            $query->orderBy('sort_index');
                        }])
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
        return new ProductCollection(Product::with(['category','images' => function($query) {
                            $query->orderBy('sort_index');
                        }])->paginate(10));
    }

    public function loadProduct(Request $request)
    {

        $result = Product::with(['category','images' => function($query) {
                            $query->orderBy('sort_index');
                        }])->where('id',$request->id)->first();
     
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

            foreach($request->product_images as $index => $product_image)
            {
                $images = new ProductImage();

                $images->product_id = $product->id;
                $images->sort_index = $index + 1;

                $file = $product_image;
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;

                try
                {
                    //$filename = $product_image->store("product");
                    $filename = Storage::disk('public')->putFile('product', $product_image, 'public');

                    $manager = new ImageManager(Driver::class);
                    
                    $image = $manager->read(Storage::path('/public/'.$filename));
    
                    $image->resize(720, 1005);
                    $image->save();
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
            //'color'=>'required'
        ]);

        $product = Product::findOrFail($id);
        
        try
        {
            $product->fill($request->only([
                'name',
                'description',
                'category_id',
                'price',
                'has_discount',
                'discount_price',
                'discount_date',
                'best_seller',
                'color',
                'sku'
            ]));

            if($request->has('has_discount') && !$request->has_discount)
            {
                $product->discount_price = null;
                $product->discount_date = null;
            }
            else
            {
                $product->discount_date = Carbon::parse($request->discount_date);
            }
            
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
                $current_images_count = ProductImage::where('product_id',$product->id)->count();

                foreach($request->product_images as $index => $product_image)
                {
                    $images = new ProductImage();
    
                    $images->product_id = $product->id;
                    $images->sort_index = $index + $current_images_count + 1;

                    $file = $product_image;
                    $ext = $file->getClientOriginalExtension();
                    $filename = time().'.'.$ext;
    
                    try
                    {
                        $filename = Storage::disk('public')->putFile('product', $product_image, 'public');
                        $manager = new ImageManager(Driver::class);
                    
                        $image = $manager->read(Storage::path('/public/'.$filename));
        
                        $image->resize(720, 1005);
                        $image->save();
                    }
                    catch(FileException $e)
                    {
    
                    }
    
                    $images->image_path = $filename;
    
                    $images->save();
                }
            }
          
            return response()->json([
                'status' => 'success',
                'message' => 'Product updated successfully'
            ],201);

           //return redirect()->route('product.list')->with('success', 'Product updated successfully.');
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

        return redirect()->route('product.list')->with('success', 'Product deleted successfully.');
    }

    public function storeProduct(Request $request)
    {
        //dd($request);
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

            //$images = $request->file('product_images') ?? []; 
            
            // Default to an empty
            // dd($request->all(), $request->file('product_images'));
            //dd($request->product_images); // Dumps the input and stops execution

            foreach($request->product_images as $index => $product_image)
            {
                    
                $images = new ProductImage();
    
                $images->product_id = $product->id;
                $images->sort_index = $index + 1;

                $file = $product_image;
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;

                try
                {
                    //$filename = $product_image->store("product");
                    $filename = Storage::disk('public')->putFile('product', $product_image, 'public');

                    $manager = new ImageManager(Driver::class);
                    
                    $image = $manager->read(Storage::path('/public/'.$filename));
    
                    $image->resize(720, 1005);
                    $image->save();
                }
                catch(FileException $e)
                {
                    return response()->json(['success' => false,
                    'message' => $e],500);
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
            return response()->json([
                'status' => 'success',
                'message' => 'Product stored successfully'
            ],201);
            //return redirect()->route('product.list')->with('success', 'Coupon added successfully!');
           // return redirect()->back()->with('success', 'Product saved successfully.');

        }
        catch(Exception $e)
        {
            return response()->json(['success' => false,
            'message' => 'Product stored failed'],500);
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
        foreach ($request->file('images') as $index => $file) {
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


    public function deleteImage(Request $request)
    {
        $imageId = $request->image_id;

        $image = ProductImage::find($imageId);

        if ($image) {
            // Delete the image file from storage
            Storage::delete($image->image_path);

            // Delete the image record from the database
            $image->delete();

            // Return a success response
            return response()->json(['status' => 'success', 'message' => 'Image deleted successfully']);
        } else {
            // Return an error response
            return response()->json(['status' => 'error', 'message' => 'Image not found'], 404);
        }
    }
}
