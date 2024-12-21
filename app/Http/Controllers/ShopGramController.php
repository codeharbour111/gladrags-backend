<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopGram;

use App\Http\Resources\ShopGramResource;
use App\Http\Resources\ShopGramCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\BannerCollection;

class ShopGramController extends Controller
{
    public function index()
    {
        $shopgram = ShopGram::paginate(10);

        return response()->json($shop_gram,200);
    }

    public function viewShopGram()
    {
        $shopgram = ShopGram::paginate(10);
        return view('pages.shopgram.shopgram-list', compact('shopgram'));
    }

    public function addShopGram()
    {
        return view('pages.shopgram.add-new-shopgram');
    }

    public function load()
    {
        return new ShopGramCollection(ShopGram::paginate(10));
    }

    public function storeShopGram(Request $request)
    {
        try
        {
            $validated = $request->validate([
            'image'=>'required']);

            $shopgram = new ShopGram();

            if($request->image)
            {
                $file = $request->image;
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;

                try
                {
                    $filename = Storage::disk('public')->putFile('shopgram', $request->file('image'), 'public');
                }
                catch(FileException $e)
                {
                    return response()->json($e,500);
                }

                $shopgram->image = $filename;
            }

            $shopgram->save();

            return redirect()->route('shopgram.list')->with('success', 'Shop Gram added successfully!');
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function editShopGram($id)
    {
        $shopgram = ShopGram::findOrFail($id);

        return view('pages.shopgram.edit-shopgram', compact('shopgram'));
    }

    public function update(Request $request,$id)
    {
        $request->validate
        ([
            'image'=>'required',
        ]);

        $shopgram = ShopGram::findOrFail($id);

        try
        {
            if($request->image)
            {
                if(Storage::disk('public')->exists($shopgram->image))
                {
                    Storage::disk('public')->delete($shopgram->image);
                }

                $file = $request->image;
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;

                try
                {
                    $filename = Storage::disk('public')->putFile('shopgram', $request->file('image'), 'public');
                }
                catch(FileException $e)
                {
                    return response()->json($e,500);
                }

                $shopgram->image = $filename;
            }

            $shopgram->save();

            return redirect()->route('shopgram.list')->with('success', 'Shop Gram saved successfully!');
          
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function destroy($id)
    {
        $shopgram = ShopGram::findOrFail($id);
        $shopgram->delete();

        return redirect()->route('shopgram.list')->with('success', 'ShopGram removed successfully!');
    }
}
