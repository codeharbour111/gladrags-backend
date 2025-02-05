<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\BannerCollection;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::paginate(10);

        return response()->json($banner,200);
    }

    public function viewBanner()
    {
        $banners = Banner::paginate(10);
        
        return view('pages.banner.banner-list', compact('banners'));
    }

    public function addBanner()
    {
        return view('pages.banner.add-new-banner');
    }

    public function load()
    {
        return new BannerCollection(Banner::paginate(10));
    }

    public function storeBanner(Request $request)
    {
        try
        {
            $validated = $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'image'=>'required']);

            $banner = new Banner();

            $banner->title  = $request->title;
            $banner->subtitle  = $request->subtitle;

            if($request->image)
            {
                $file = $request->image;
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;

                try
                {
                    $filename = Storage::disk('public')->putFile('banner', $request->file('image'), 'public');
                   
                    $manager = new ImageManager(Driver::class);
                    
                    $image = $manager->read(Storage::path('/public/'.$filename));
    
                    $image->resize(2000, 1034);
                    $image->save();
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

    public function editBanner($id)
    {
        $banner = Banner::findOrFail($id);

        return view('pages.banner.edit-banner', compact('banner'));
    }

    public function update(Request $request,$id)
    {
        $request->validate
        ([
            'title'=>'required',
        ]);

        $banner = Banner::findOrFail($id);

        try
        {
            $banner->title  = $request->title;
            $banner->subtitle = $request->subtitle;

            if($request->image)
            {
                if(Storage::disk('public')->exists($banner->image))
                {
                    Storage::disk('public')->delete($banner->image);
                }

                $file = $request->image;
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;

                try
                {
                    $filename = Storage::disk('public')->putFile('banner', $request->file('image'), 'public');

                    $manager = new ImageManager(Driver::class);
                    
                    $image = $manager->read(Storage::path('/public/'.$filename));
    
                    $image->resize(2000, 1034);
                    $image->save();
                }
                catch(FileException $e)
                {
                    return response()->json($e,500);
                }

                $banner->image = $filename;
            }

            $banner->save();

            return redirect()->route('banner.list')->with('success', 'Babber saved successfully!');

        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->route('banner.list')->with('success', 'Banner removed successfully!');
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

                    $manager = new ImageManager(Driver::class);
                    
                    $image = $manager->read(Storage::path('/public/'.$filename));
    
                    $image->resize(2000, 1034);
                    $image->save();
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
