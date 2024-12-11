<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::paginate(10);

        return response()->json($categories,200);
    }


    public function load()
    {
        return new CategoryCollection(Categories::paginate(10));
    }

    public function show($id)
    {
        $category = Categories::find($id);

        if($category)
        {
            return response()->json(
                [
                    'status'  => 'success',
                    'data'    =>  new CategoryResource($category)
                ],201);;
        }
        else
        {
            return response()->json(
            [
                'status'  => 'error',
                'message' => 'Categories not found'
            ]);
        }
    }

    public function store(Request $request)
    {
        try
        {
            $validated = $request->validate
            ([
                'name'  => 'required|unique:categories',
                'image' => 'required',
                'sizes' => 'required'
            ]);

            $category = new Categories();

            $category->name  = $request->name;
            $category->image = $request->image;
            $category->sizes = $request->sizes;

            if($request->image)
            {
                $file = $request->image;
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;

                try
                {
                    $filename = Storage::disk('public')->putFile('category', $request->file('image'), 'public');
                }
                catch(FileException $e)
                {
                    return response()->json($e,500);
                }

                $category->image = $filename;
            }

            $category->save();

            return response()->json
            (
            [
                'status'  => 'success',
                'message' => 'Categories added'
            ],201);
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
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

            //dd($category);

            if($request->image)
            {
                $file = $request->image;
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;

                try
                {
                    $filename = Storage::disk('public')->putFile('category', $request->file('image'), 'public');
                }
                catch(FileException $e)
                {
                    return response()->json($e,500);
                }

                $category->image = $filename;
            }

            $category->save();

            // return response()->json( [
            //     'status'=>'success',
            //     'message' => 'Categories added'
            // ],201);

            return redirect()->route('category.list')->with('success', 'Category added successfully!');
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function viewCategory()
    {
        $categories = Categories::paginate(10);
        return view('pages.categories.category-list', compact('categories'));
    }

    public function addCategory()
    {
        return view('pages.categories.add-new-category');
    }

    public function update_category($id, Request $request)
    {
        try
        {
            $validated = $request->validate
            ([
                'name'  => 'required|unique:categories',
                'image' => 'required',
                'sizes' => 'required'
            ]);

            $category = Categories::find($id);

            $category->name  = $request->name;
            $category->image = $request->image;
            $category->sizes = $request->sizes;

            if(Storage::disk('public')->exists($category->image))
            {
                Storage::disk('public')->delete($category->image);
            }

            if($request->image)
            {
                $file = $request->image;
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;

                try
                {
                    $filename = Storage::disk('public')->putFile('category', $request->file('image'), 'public');
                }
                catch(FileException $e)
                {
                    return response()->json($e,500);
                }

                $category->image = $filename;
            }

            $category->update();
            // Categories::where('id',$id)
            //             ->update(['name'=>$request->name]);

            return response()->json
            ([
                'status'  => 'success',
                'message' => 'Categories updated'
            ],201);
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function delete_brand($id)
    {
        $category = Categories::find($id);

        if(Storage::disk('public')->exists($category->image))
        {
            Storage::disk('public')->delete($category->image);
        }

        if($category)
        {
            $category->delete();

            return response()->json
            ([
                'status'  => 'success',
                'message' => 'Categories deleted'
            ],201);
        }
        else
        {
            return response()->json
            ([
                'status'  => 'error',
                'message' => 'Categories not found'
            ],201);
        }
    }
}
