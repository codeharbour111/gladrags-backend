<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Inventory;
use App\Models\Categories;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::all();
        return view('pages.products.all-products');
    }

    public function addProduct()
    {
        $categories = Categories::all();
        return view('pages.products.add-new-product',compact('categories'));
    }

    public function load()
    {
        $now = Carbon::now();
        $unique_code = $now->format('YmdHisu');
        dd($unique_code);
        return response()->json(Product::with('category','images')->paginate(10),200);
    }


    public function store(Request $request)
    {
        $request->validate([
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
            dd($product);

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

    public function storeProduct(Request $request)
    {
        $request->validate([
            // 'name'=>'required',
            // 'category_id'=>'required',
            // 'description'=>'required',
            // 'price'=>'required',
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


    public function storeImages(Request $request)
    {
        // Hard-code the product_id
        $productId = 1;  // Set the product_id you want to hard-code

        // Validate the uploaded images
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Array to store file paths
        $uploadedFiles = [];

        // Check if images are uploaded
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store the image in the public disk
                $path = $image->store('uploads', 'public');

                // Save the image with the hard-coded product_id
                $productImage = new ProductImage();
                $productImage->product_id = $productId;  // Use the hard-coded product_id
                $productImage->image_path = $path;
                $productImage->save();

                // Store the path for response
                $uploadedFiles[] = $path;
            }
        }

        // Return a success response with uploaded file paths
        return response()->json([
            'success' => true,
            'message' => 'Images uploaded and saved successfully',
            'files' => $uploadedFiles,
        ]);
    }
}
