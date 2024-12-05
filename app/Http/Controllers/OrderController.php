<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
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
        // $request->validate([
        //     'customer_name'=>'required',
        //     'customer_email'=>'required',
        //     'customer_phone_no'=>'required',
        //     'customer_address'=>'required',
        //     'total_price'=>'required|numeric',
        //     'order_items'=>'required',
        // ]);

        $data = $request->json()->all();
        
        try
        {
            $order = new Order();

            $order->user_id = $data['user_id'];
            //$order->order_number = Str::orderedUuid();
            $order->customer_name = $data['customer_name'];
            $order->customer_email = $data['customer_email'];
            $order->customer_phone_no = $data['customer_phone_no'];
            $order->customer_address = $data['customer_address'];
            $order->total_price = $data['total_price'];
            $order->delivery_date = '2024-10-10';

            $order->save();

            $order_items_array = $data['order_items'];

            foreach($order_items_array as $order_items)
            {
                $item = new OrderItem();

                $item->order_id = $order->id;
                $item->product_id = $order_items['product_id'];
                $item->price = $order_items['price'];
                $item->quantity =  $order_items['quantity'];
                $item->size = $order_items['size'];
                
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
