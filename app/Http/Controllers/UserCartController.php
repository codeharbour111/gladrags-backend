<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCart;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Validator;

class UserCartController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'carts' => 'required',
        ]);
        $userId = $request->input('user_id');
        $carts = $request->input('carts');

        $cart = UserCart::upsert([
            [
                'user_id' => $userId,
                'carts' => $carts,
            ]
        ],['user_id']);

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart successfully.',
            'data' => $cart
        ], 200);
    }

    public function getCartProducts(Request $request, $userId)
    {
        $cartProducts = UserCart::where('user_id', $userId)
            ->first();

        return response()->json([
            'status' => 'success',
            'data' => new CartResource($cartProducts)
        ], 200);
    }
}
