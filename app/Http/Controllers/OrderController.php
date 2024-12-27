<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\OrderStatusHistory;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

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

    public function getOrdersByUserId($userId)
    {
        $orders = Order::with(['items.product.images', 'user', 'statusHistory'])
            ->where('user_id', $userId)
            ->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No orders found for this user.'
            ], 404);
        }

        return new OrderCollection($orders);
    }

    public function load()
    {
        return response()->json(Product::with('category','images')->paginate(10),200);
    }

    public function getOrderDetails($id)
    {
        $order = Order::with(['items.product.images', 'user', 'statusHistory'])->find($id);

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found.'
            ], 404);
        }

        return new OrderResource($order);
    }

    public function update_status(Request $request)
    {
       try
       {
            $order = Order::find($request->order_id);
            $order->status = $request->status;

            if($request->status == 'delivered')
            {
                $order->delivered_date = date('Y-m-d H:i:s');
            }

            if($request->status == 'cancelled')
            {
                $order->cancelled_date = date('Y-m-d H:i:s');
            }

            if($order->user_id != null)
            {
                OrderStatusHistory::create([
                    'order_id' => $order->id,
                    'status' => $request->status,
                    'user_id' => $order->user_id
                ]);
            }

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
            'location' => 'required',
            'total_price'=>'required|numeric',
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
            $order->discount_code = $request->discount_code;
            $order->discount = $request->discount;
            $order->location = $request->location;
            $order->shipping_fee = $request->shipping_fee;
            $order->total_quantity = $request->total_quantity;
            $order->subtotal = $request->subtotal;
            $order->total_price = $request->total_price;
            $order->order_note = $request->order_note;
            
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

            if($order->user_id != null)
            {
                OrderStatusHistory::create([
                    'order_id' => $order->id,
                    'status' => 'pending',
                    'user_id' => $order->user_id
                ]);
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
