<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Categories::paginate(10);
        return view('pages.categories.category-list', compact('categories'));
    }

    public function addCategory()
    {
        return view('pages.categories.add-new-category');
    }

    public function storeCategory(Request $request)
    {
        try
        {
            $validated = $request->validate([
            'name' => 'required|unique:categories',
            'image'=>'required',
            'sizes'=>'required']);

            $category = new Categories();

            $category->name  = $request->name;
            $category->image = $request->image;
            $category->sizes = $request->sizes;

            // if ($request->hasFile('image')) {
            //     $file = $request->file('image');
            //     $filename = time() . '.' . $file->getClientOriginalExtension();

            //     try {
            //         $filePath = $file->storeAs('category', $filename, 'public'); // Store in 'public' disk
            //         $category->image = $filePath; // Save relative path
            //     } catch (FileException $e) {
            //         return response()->json('error', 'Error uploading image.');
            //     }
            // }
            if($request->image)
            {
                $file = $request->image;
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;

                try
                {
                    //$filename = $request->file('image')->store("category/{$filename}");
                    $filename = $request->file('image')->store("category");
                }
                catch(FileException $e)
                {
                    return response()->json($e,500);
                    //dd($e);
                }

                $category->image = $filename;
            }

            // $category->sizes = json_encode($request->sizes);

            $category->save();

            // return response()->json('Category added',201);
            return redirect()->route('category.list')->with('success', 'Category added successfully!');
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }

    }
}
