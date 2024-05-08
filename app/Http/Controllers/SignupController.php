<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SignupController extends Controller
{
    // Show the signup form
    public function index(Request $req){
        return view('view');
    }

    // Save user data to the database
    public function save(Request $req){
        // Validate the incoming request
        $validated = $req->validate([
            'name'=> 'required|alpha',
            'email'=> 'required|email|unique:users',
            'password'=> 'required'
        ]);
    
        // Get the current date and time
        $date = date("Y-m-d H:i:s");
        
        // Create a new User instance
        $user = new User();
        
        // Insert user data into the database
        $user->insert([
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'password' => Hash::make($req->input('password')),
            'created_at' => date($date),
            'updated_at' => date($date),
        ]);
    
        // Redirect to the users page in the admin panel
        return redirect('admin/users');
    }
}