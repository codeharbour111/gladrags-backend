<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function index()
    {
        $categories = Categories::paginate(10);
        
        dd(asset('/storage/app/public/images/example.png'));

        return response()->json($categories,200);
    }

    public function load()
    {
        $categories = Categories::paginate(10);

        return response()->json($categories,200);
    }

    public function show($id)
    {
        $categories = Categories::find($id);

        if($categories)
        {
            return response()->json($categories,200);
        }
        else
        {
            return response()->json('Categories not found');
        }
    }

    public function store(Request $request)
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

            $category->save();

            return response()->json('Category added',201);
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function update_brand($id, Request $request)
    {
        try
        {
            $validated = $request->validate
            ([
                'name'=>'required|unique:categories,name',
                'image'=>'required',
                'size'=>'required'
            ]);

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

            Categories::where('id',$id)->update(['name'=>$request->name]);

            return response()->json('brand updated',200);
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function delete_brand($id)
    {
        $category = Categories::find($id);
        
        if($category){
            $category->delete();
            return response()->json("Category deleted");
        }
        else{
            return response()->json("Category not found");
        }
    }
}
