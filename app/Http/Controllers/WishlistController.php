<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'user_id' => 'required',
        ]);

        $wishlists = Wishlist::where('user_id', $request->input('user_id'));

        $wishlists->delete();

        $userId = $request->input('user_id');
        $productIds = $request->input('product_ids');

        foreach ($productIds as $productId) {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Products added to wishlist successfully.'
        ], 200);
    }

    public function getWishlistProducts(Request $request, $userId)
    {
        $wishlistProductIds = Wishlist::where('user_id', $userId)->pluck('product_id');

        $products = Product::with(['category', 'images'])
            ->whereIn('id', $wishlistProductIds)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => ProductWithIdResource::collection($products)
        ], 200);
        
    }

    public function getWishlistProductIds(Request $request, $userId)
    {
        $wishlistProductIds = Wishlist::where('user_id', $userId)->pluck('product_id');

        return response()->json([
            'status' => 'success',
            'data' => $wishlistProductIds
        ], 200);
    }
}
