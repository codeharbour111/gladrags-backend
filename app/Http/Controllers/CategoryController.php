<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    //
    public function index()
    {
        return view('pages.categories.category-list');
    }

    public function addCategory()
    {
        return view('pages.categories.add-new-category');
    }

    public function storeCategory(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'avatar' => 'nullable|string', // Handle base64 image validation
            'size' => 'nullable|array',    // Ensure size is an array if selected
            'size.*' => 'in:S,M,L,XL,XXL', // Validate each size value
        ]);

        // Get the base64 encoded image data
        $base64Image = $request->input('avatar');

        if ($base64Image) {
            // Extract the image data and file extension from the base64 string
            list($type, $data) = explode(';', $base64Image);
            list(, $data) = explode(',', $data);

            // Decode the base64 data
            $imageData = base64_decode($data);

            // Generate a unique filename and save the image in storage
            $imageName = uniqid('category_') . '.png';  // Change the extension based on the image type
            Storage::disk('public')->put('categories/' . $imageName, $imageData);
        }

        // Store the selected sizes as a comma-separated string
        $sizes = $request->input('size');
        $sizes = $sizes ? implode(',', $sizes) : null;

        // Create a new category record
        $category = Category::create([
            'name' => $validated['category_name'],
            'avatar' => $imageName ?? null, // Store the image filename if available
            'size' => $sizes,              // Store the sizes (if any)
        ]);

        // Redirect back with a success message
        return redirect()->route('category.list')->with('success', 'Category added successfully!');

    }
}
