<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        return view('pages.users.all-users', compact('users'));
    }
    
    public function addUser()
    {
        return view('pages.users.add-user');
    }

    public function settings()
    {
        return view('pages.users.settings');
    }

    public function storeUser(Request $request)
    {
        try
        {
           
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required'],
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $user->save();

            return response()->json
            (
            [
                'status'  => 'success',
                'message' => 'User added'
            ],201);
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);

        return view('pages.users.edit-user', compact('user'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'current_password' => ['required'],
            'new_password' => ['required'], //, 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::findOrFail($id);

        if(!Hash::check($request->current_password, $user->password))
        {
            return response()->json
            (
            [
                'status'  => 'error',
                'message' => 'Current password is incorrect'
            ],401);
        }

        try
        {
            $user->name  = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->new_password);

            $user->save();

            return response()->json
            (
            [
                'status'  => 'success',
                'message' => 'User updated'
            ],201);

        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function destroy($id)
    {
        $banner = User::findOrFail($id);
        $banner->delete();

        return redirect()->route('user.list')->with('success', 'User removed successfully!');
    }
}
