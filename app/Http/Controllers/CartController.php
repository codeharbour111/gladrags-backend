<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string',
            'quantity' => 'required|integer|min=1',
            'price' => 'required|integer',
            'total' => 'required|integer',
        ]);

        $cart = Cart::create([
            'user_id' => $request->input('user_id'),
            'product_id' => $request->input('product_id'),
            'size' => $request->input('size'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            'total' => $request->input('total'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart successfully.',
            'data' => $cart
        ], 200);
    }

    public function getCartProducts(Request $request, $userId)
    {
        $cartProducts = Cart::with(['product.category', 'product.images'])
            ->where('user_id', $userId)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => CartResource::collection($cartProducts)
        ], 200);
    }
}
