<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // public function index()
    // {
    //     return view('pages.orders.order-list');
    // }

    public function index()
    {
        $orders = Order::all();
        
        return view('pages.orders.order-list',compact('orders'));
    }


    public function detail(Request $request)
    {
        $order = Order::find($request->id);
        $order_items = OrderItem::with(['product','product.images'])->where('order_id',$request->id)->get();

        return view('pages.orders.order-detail',compact('order', 'order_items'));
    }

    public function load()
    {
        return response()->json(Product::with('category','images')->paginate(10),200);
    }

    public function update_status(Request $request)
    {
       try
       {
            $order = Order::find($request->order_id);
            $order->status = $request->status;

            $order->save();

            return response()->json(
                [
                    'status'  => 'success',
                    'message' =>  'Status updated successfully.'
                ],201);
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'=>'required',
            'customer_email'=>'required',
            'customer_phone_no'=>'required',
            'customer_address'=>'required',
            'total_price'=>'required|numeric',
            //'delivery_date'=>'required',
            //'order_items'=>'required',
        ]);

        try
        {
            $order = new Order();

            $order->user_id = $request->user_id;
            //$order->order_number = Str::orderedUuid();
            $order->customer_name = $request->customer_name;
            $order->customer_email = $request->customer_email;
            $order->customer_phone_no = $request->customer_phone_no;
            $order->customer_address = $request->customer_address;
            $order->total_price = $request->total_price;
            $order->delivery_date = $request->delivery_date;
            
            $order->save();

            $order_items_array = $request->order_items;
           

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

              return response()->json(
                [
                    'status'  => 'success',
                    'message' =>  'Order added successfully.'
                ],201);
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }
}
