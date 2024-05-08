<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Login page
    public function index(Request $req)
    {
        // Fetch categories for view
        $categories = DB::table('categories')->orderBy('id', 'desc')->get();
        $data['categories'] = $categories;
        return view('auth.login', $data);
    }

    // Handle login form submission
    public function save(Request $req){
        // Validate form data
        $validated = $req->validate([
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        // Attempt to authenticate user
        if(Auth::attempt($validated,$req->input('remember'))){
            // Authentication successful, regenerate session
            $req->session()->regenerate();
            
            return redirect()->intended('admin');
        };

        // Authentication failed, redirect back with error message
        return back()->withErrors([
            'email'=>'Wrong email or password'
        ]);
    }
}