<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public function showLoginForm()
{
    $categories = Category::all(); 
    return view('auth.login', ['categories' => $categories]);
}
}
