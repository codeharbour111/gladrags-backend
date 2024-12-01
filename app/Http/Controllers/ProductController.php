<?php

namespace App\Http\Controllers;

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
        return view('pages.products.add-new-product');
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image
            'product_title' => 'required|string|max:20',
            'category' => 'required|integer',
            'price' => 'required|numeric',
            'size' => 'required|in:S,M,L,XL,XXL',
            'stock' => 'required|integer',
            'sale_price' => 'nullable|numeric',
            'schedule' => 'nullable|date',
            'brand' => 'required|string',
            'sku' => 'nullable|string',
            'tags' => 'nullable|string',
            'description' => 'required|string|max:100',
        ]);

        // Process and store the images
        $imageUrls = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Generate unique filename
                $filename = time() . '_' . $image->getClientOriginalName();
                // Store the image in 'images/products' directory
                $image->storeAs('images/products', $filename, 'public');
                // Add the public URL to the array
                $imageUrls[] = Storage::url("images/products/{$filename}");
            }
        }

        // // Process and convert images to Base64
        // $base64Images = [];
        // if ($request->hasFile('images')) {
        //     foreach ($request->file('images') as $image) {
        //         // Get the file content
        //         $imageContent = file_get_contents($image->getRealPath());
        //         // Encode the content to Base64
        //         $base64Image = base64_encode($imageContent);
        //         // Create a full Base64 string with MIME type
        //         $base64Images[] = 'data:' . $image->getMimeType() . ';base64,' . $base64Image;
        //     }
        // }

        // Prepare the data for storing in the database (example only)
        $productData = [
            'product_title' => $validated['product_title'],
            'category_id' => $validated['category'], // Assuming categories are stored by ID
            'price' => $validated['price'],
            'size' => $validated['size'],
            'stock' => $validated['stock'],
            'sale_price' => $validated['sale_price'] ?? null,
            'schedule' => $validated['schedule'] ?? null,
            'brand' => $validated['brand'],
            'sku' => $validated['sku'] ?? null,
            'tags' => $validated['tags'] ?? null,
            'description' => $validated['description'],
            'images' => json_encode($imageUrls), // Store the images as a JSON array
            // 'images' => json_encode($base64Images), // Store the images as a JSON array of Base64 strings
        ];

        // Save the data to the database (assuming a Product model)
        $product = Product::create($productData);

        // Return a success response
        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product,
        ]);

    }
}
