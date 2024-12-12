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
        try{
            $request->validate([
            
                'email'   => 'required|email',
                'password' => 'required|min:6'
            ]);

            // $user = User::where('username', $username)->first();  

            // if (Hash::check(Input::get('password'), $user->password))
            // {
            //     // The passwords match...
            // }

            if (Auth::guard('gladrags_users')
                    ->attempt(['email' => $request->email, 'password' => $request->password], 
                $request->get('remember')))
            {
                //$user = Auth::user();   
                //$token = $user->tokens()->where('personal_access_tokens.name', 'remember_token')->first();
                $user = GladragsUser::where('email', $request->email)->first();
                return response()->json(
                    [
                        'status'  => 'success',
                        'data' =>  [
                            'user' => $user
                        ]
                    ],201);
            }
            else{
                return response()->json(
                    [
                        'status'  => 'error',
                        'message' =>  'Login failed.'
                    ],201);
            }
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }
   

        protected function register(Request $request)
        {
            try{
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
                        'data' =>  [
                            'user' => $gladrag_user
                        ]
                    ],201);

            }
            catch(Exception $e)
            {
                return response()->json($e,500);
            }
        }
}
