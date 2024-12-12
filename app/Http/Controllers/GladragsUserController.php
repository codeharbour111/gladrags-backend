<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\GladragsUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;    
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class GladragsUserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
           
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('gladrags_users')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')))
        {
            return response()->json(
                [
                    'status'  => 'success',
                    'message' =>  'Login successfully.'
                ],201);;
        }

         return response()->json(
            [
                'status'  => 'error',
                'message' =>  'Login failed.'
            ],201);
    }
   

        protected function register(Request $request)
        {
            $request->validate([
                'name'   => 'required',
                'email'   => 'required|email',
                'password' => 'required|min:6'
            ]);

            $gladrag_user = GladragsUser::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

              return response()->json(
                [
                    'status'  => 'success',
                    'message' =>  'Registered successfully.'
                ],201);
        }
}
