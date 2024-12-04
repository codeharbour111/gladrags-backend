<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::paginate(10);

        return response()->json($banner,200);
    }

    public function load()
    {
        return new BannerCollection(Banner::paginate(10));
    }

    public function show($id)
    {
        $banner = Banner::find($id);

        if($banner)
        {
            return response()->json($banner,200);
        }
        else
        {
            return response()->json(
            [
                'status'  => 'success',
                'message' => 'Banner not found'
            ]);
        }
    }

    public function store(Request $request)
    {
        try
        {
            $validated = $request->validate
            ([
                'title'  => 'required',
                'subtitle'  => 'required',
                'image' => 'required'
            ]);

            $banner = new Banner();

            $banner->title  = $request->title;
            $banner->subtitle = $request->subtitle;

            if($request->image)
            {   
                $file     = $request->image;
                $ext      = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;

                try
                {
                    $filename = Storage::disk('public')->putFile('banner', $request->file('image'), 'public');
                }
                catch(FileException $e)
                {
                    return response()->json($e,500);
                }

                $banner->image = $filename;
            }

            $banner->save();

            return response()->json
            (
            [
                'status'  => 'success',
                'message' => 'Banner added'
            ],201);
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function update_category($id, Request $request)
    {
        try
        {
            $validated = $request->validate
            ([
                'title'  => 'required|unique:banner',
                'subtitle'  => 'required',
                'image' => 'required',
            ]);

            $banner = Banner::find($id);

            $banner->title = $request->title;
            $banner->subtitle = $request->subtitle;

            if(Storage::disk('public')->exists($banner->image))
            {
                Storage::disk('public')->delete($banner->image);
            }

            if($request->image)
            {   
                $file     = $request->image;
                $ext      = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;

                try
                {
                    $filename = Storage::disk('public')->putFile('banner', $request->file('image'), 'public');
                }
                catch(FileException $e)
                {
                    return response()->json($e,500);
                }

                $banner->image = $filename;
            }

            $banner->update;

            // Banner::where('id',$id)
            //             ->update(['title'=>$request->title,
            //                       'subtitle'=>$request->subtitle]);

            return response()->json
            ([
                'status'  => 'success',
                'message' => 'Banner updated'
            ],201);
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function delete_brand($id)
    {
        $banner = Banner::find($id);

        if(Storage::disk('public')->exists($banner->image))
        {
            Storage::disk('public')->delete($banner->image);
        }
        
        if($banner)
        {
            $banner->delete();

            return response()->json
            ([
                'status'  => 'success',
                'message' => 'Banner deleted'
            ],201);
        }
        else
        {
            return response()->json
            ([
                'status'  => 'error',
                'message' => 'Banner not found'
            ],201);
        }
    }
}
