<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('pages.orders.order-list');
    }

    public function orderDetail()
    {
        return view('pages.orders.order-detail');
    }

    public function load()
    {
        return response()->json(Product::with('category','images')->paginate(10),200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'=>'required',
            'customer_email'=>'required',
            'customer_phone_no'=>'required',
            'customer_address'=>'required',
            'total_price'=>'required|numeric',
            'delivery_date'=>'required',
            'order_items'=>'required',
        ]);

        try
        {
            $order = new Order();

            $order->user_id = $request->user_id;
            $order->order_number = Str::orderedUuid();
            $order->customer_name = $request->customer_name;
            $order->customer_email = $request->customer_email;
            $order->customer_phone_no = $request->customer_phone_no;
            $order->customer_address = $request->customer_address;
            $order->total_price = $request->total_price;
            $order->delivery_date = $request->delivery_date;

            dd($order);
            
            $order->save();

            foreach($request->order_items as $order_items)
            {
                $item = new OrderItem();

                $item->order_id = $order->id;
                $item->price = $item->price;
                $item->quantity = $item->quantity;
                $item->size = $item->size;
                
                $item->save();   
            }

            return response()->json('Order added',201);
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }
}
