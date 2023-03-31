<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('Auth.Register-page');
    }

    public function register(Request $request)
    {   
        $validated = $request->validate([
            'name' => 'required|min:6',
            'email' => 'required|min:6|unique:users',
            'password'=>'required|min:6'
        ]);
        $validated['role'] = 'admin';
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        session()->flash('message', 'Registration Success, please login');

        return redirect('/login');
    }
}
