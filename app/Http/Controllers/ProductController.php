<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        return view('pages.products.all-products');
    }

    public function addProduct()
    {
        return view('pages.products.add-new-product');
    }
}
