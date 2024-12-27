<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderStatusHistoryController extends Controller
{
    //

    public function index()
    {
        $orderStatusHistories = OrderStatusHistory::all();
        return response()->json([
            'status' => 'success',
            'data' => $orderStatusHistories
        ]);
    }

    public function show($id)
    {
        $orderStatusHistory = OrderStatusHistory::find($id);

        if ($orderStatusHistory) {
            return response()->json([
                'status' => 'success',
                'data' => $orderStatusHistory
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Order status history not found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $orderStatusHistory = OrderStatusHistory::find($id);

        if ($orderStatusHistory) {
            $orderStatusHistory->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Order status history deleted successfully.'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Order status history not found'
            ], 404);
        }
    }

    public function getOrderStatusHistoriesByOrderId(Request $request)
    {
        $orderId = $request->input('order_id');

        $orderStatusHistories = OrderStatusHistory::where('order_id', $orderId)->get();

        return response()->json([
            'status' => 'success',
            'data' => $orderStatusHistories
        ], 200);
    }

    public function getOrderStatusHistoriesByUserId(Request $request)
    {
        $userId = $request->input('user_id');

        $orderStatusHistories = OrderStatusHistory::whereHas('order', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return response()->json([
            'status' => 'success',
            'data' => $orderStatusHistories
        ], 200);
    }

}
