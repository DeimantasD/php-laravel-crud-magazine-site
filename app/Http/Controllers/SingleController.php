<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SingleController extends Controller
{
    // Display a single post based on its slug
    public function index(Request $req, $id = ''){
        // Query to select the post with the given slug
        $query = "SELECT * FROM posts WHERE slag = :slag limit 1";
        $row = DB::select($query, ['slag' => $id]);
    
        // If a post with the given slug exists
        if ($row) { 
            // Query to select the category of the post
            $category = DB::select('SELECT * FROM categories WHERE id = :id LIMIT 1', ['id' => $row[0]->category_id ]);
            
            // Prepare data to pass to the view
            $data['row'] = $row[0];
            $data['category'] = $category[0];
        } 
        
        // Query to select all categories
        $query = "SELECT * FROM categories ORDER BY id desc";
        $categories = DB::select($query);
    
        // Add categories data to the array to pass to the view
        $data['categories'] = $categories;
    
        // Return the view with data
        return view('single', $data);
    }

    // Save function to handle form submission 
    public function save(Request $req){
        // Validate the incoming request
        $validate = $req->validate([
            'key'=> 'required|string',
            'key'=> 'required|image'
        ]);
        // Return the view 
        return view('single');
    }
}