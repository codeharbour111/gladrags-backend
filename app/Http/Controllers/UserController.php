<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.users.all-users');
    }

    public function addUser()
    {
        return view('pages.users.add-user');
    }

    public function settings()
    {
        return view('pages.users.settings');
    }
}
