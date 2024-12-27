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

    protected function update_password(Request $request)
    {
        try{
            $request->validate(
            [
                'user_id' => 'required',
                'current_password'   => 'required',
                'new_password' => 'required',
            ]);
           
            $user = GladragsUser::where('id', $request->user_id)->first();  

            if($user)
            {
                if (Hash::check($request->current_password, $user->password))
                {
                    $user->password = Hash::make($request['new_password']);
                    $user->save();

                    return response()->json(
                        [
                            'status'  => 'success',
                            'message' => 'Password saved successfully.'
                        ],201);
                }
                else{
                    return response()->json(
                        [
                            'status'  => 'error',
                            'message' => 'Wrong password'
                        ],201);
                }
            }
            else{
                return response()->json(
                    [
                        'status'  => 'error',
                        'message' => 'User not found'
                    ],201);
            }

        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }
   
    protected function update_address(Request $request)
    {
        try{
            $request->validate([
                'user_id' => 'required',
                'fullname'   => 'required',
                'phone_no' => 'required',
                'address'   => 'required',
                'city' => 'required',
            ]);
           

            $user = GladragsUser::where('id', $request->user_id)->first();
            
            $user->name = $request->fullname;
            $user->phone_no = $request->phone_no;
            $user->address = $request->address;
            $user->city = $request->city;
            
            $user->save();

            return response()->json(
                [
                    'status'  => 'success',
                    'data' =>  [
                        'user' => $user
                    ]
                ],201);

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
                    'phone_no' => $request['phone_no'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                ]);

                $user = GladragsUser::where('email', $gladrag_user->email)->first();

                return response()->json(
                    [
                        'status'  => 'success',
                        'data' =>  [
                            'user' => $user
                        ]
                    ],201);

            }
            catch(Exception $e)
            {
                return response()->json($e,500);
            }
        }
}
