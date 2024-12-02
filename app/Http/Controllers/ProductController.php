<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::all();
        return view('pages.products.all-products');
    }

    public function addProduct()
    {
        return view('pages.products.add-new-product');
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
}
