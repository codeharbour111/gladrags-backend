<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        return view('pages.categories.category-list');
    }

    public function addCategory()
    {
        return view('pages.categories.add-new-category');
    }
}
