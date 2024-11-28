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
}
