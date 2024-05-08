<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\MyPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // Home page
    public function index(Request $req){
        // Pagination
        $limit = 10;
        $page = $req->input('page') ? (int)$req->input('page') : 1;
        $offset = ($page - 1) * $limit;
        $page_class = new MyPage();
        $links = $page_class->make_links($req->fullUrlWithQuery(['page' => $page]), $page,1);

        // Fetch posts based on search criteria
        if($req->input('find')){
            // Search by post title
            $query = "SELECT posts.*,categories.category FROM posts JOIN categories ON posts.category_id = categories.id WHERE title like :title limit $limit offset $offset";
            $title = "%" . $req->input('find') . "%";
            $rows = DB::select($query,['title'=>$title]);
        }else{
            // Fetch all posts
            $query = "SELECT posts.*,categories.category FROM posts JOIN categories ON posts.category_id = categories.id limit $limit offset $offset";
            $rows = DB::select($query);
        }

        // Fetch posts based on category
        if($req->input('cat')){
            // Search by category
            $query = "SELECT posts.*,categories.category FROM posts JOIN categories ON posts.category_id = categories.id WHERE category_id = :id limit $limit offset $offset";
            $id = $req->input('cat');
            $rows = DB::select($query,['id'=>$id]);
        }

        // Process fetched posts
        $img = new Image();
        foreach ($rows as $key => $row) {
            $rows[$key]->image = $img->get_thumb_post('uploads/' .$row->image);
        }

        // Fetch all categories
        $categories = Category::all();

        // Prepare data for view
        $data['rows'] = $rows;
        $data['categories'] = $categories;
        $data['page_title'] = 'Home';
        $data['links'] = $links;

        return view('index', $data);
    }

    // Save method
    public function save(Request $req){
        $validate = $req->validate([
            'key'=> 'required|string',
            'key'=> 'required|image'
        ]);
        return view('index');
    }
}