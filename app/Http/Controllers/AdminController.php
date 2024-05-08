<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\MyPage;

class AdminController extends Controller
{
    // Admin dashboard
    public function index(Request $req){
        return view('admin.admin',['page_title'=> 'Dashboard']);
    }

    // CRUD operations for posts
    public function posts(Request $req, $type = '', $id = ''){
        switch ($type) {
            case 'add':
                // Add new post
                if($req->method() == 'POST'){
                    $post = new Post();
                    $validated = $req->validate([
                        'title' => 'required|string',
                        'image' => 'required|image',
                        'content' => 'required',
                    ]);
                    $path = $req->file('image')->store('/', ['disk'=>'my_disk']);

                    $data['title'] = $req->input('title');
                    $data['category_id'] = $req->input('category_id');
                    $data['image'] = $path;
                    $data['content'] = $req->input('content');
                    $data['created_At'] = date("Y-m-d H:i:s");
                    $data['updated_at'] =  date("Y-m-d H:i:s");
                    $data['slag'] =  $post->str_to_url($data['title']);
                    
                    $post->insert($data);
                    return redirect('admin/posts');
                }

                // Fetch categories for post
                $query = "SELECT * FROM categories ORDER BY id desc";
                $categories = DB::select($query);

                return view('admin.add_post',[
                    'page_title'=> 'New Post',
                    'categories'=> $categories
                ]);
                break;

            case 'edit':
                // Edit post
                $post = new Post();
                
                if($req->method() == 'POST'){
                    
                    $validated = $req->validate([
                        'title' => 'required|string',
                        'image' => 'image',
                        'content' => 'required'
                    ]);

                    if($req->file('image')){
                        $oldrow = $post->where('id',$id);
                        $path = $req->file('image')->store('/', ['disk'=>'my_disk']);
                        $data['image'] = $path;
                    }

                    $data['id'] = $id;
                    $data['title'] = $req->input('title');
                    $data['category_id'] = $req->input('category_id');
                    $data['content'] = $req->input('content');
                    $data['updated_at'] = date("Y-m-d H:i:s");
                    
                    $post->where('id',$id)->update($data);

                    return redirect('admin/posts/edit/'.$id);
                }

                // Fetch post details for editing
                $row = $post->find($id);
                $category = $row->category()->first();

                $query = "SELECT * FROM categories ORDER BY id desc";
                $categories = DB::select($query);

                return view('admin.edit_post',[
                    'page_title'=> 'Edit Post',
                    'row'=> $row,
                    'category'=> $category,
                    'categories'=> $categories
                ]);
                break;

            case 'delete':
                // Delete post
                $post = new Post();
                $row = $post->find($id);
                $category = $row->category()->first();
                
                if($req->method() == 'POST'){
                    $row->delete();
                    return redirect('admin/posts/posts');
                }

                return view('admin.delete_post',[
                    'page_title'=> 'Delete Post',
                    'row'=> $row,
                    'category' => $category,
                ]);
                break;

            default:
                // Fetch all posts
                $limit = 10;
                $page = $req->input('page') ? (int)$req->input('page') : 1;
                $offset = ($page - 1) * $limit;
                $page_class = new MyPage();
                $links = $page_class->make_links($req->fullUrlWithQuery(['page' => $page]), $page,1);
                
                $query = "SELECT posts.*,categories.category FROM posts JOIN categories ON posts.category_id = categories.id limit $limit OFFSET $offset";
                $img = new Image();

                $rows = DB::select($query);
                foreach ($rows as $key => $row) {
                    $rows[$key]->image = $img->get_thumb('uploads/' .$row->image);
                }
                $data['rows'] = $rows;
                $data['page_title'] = 'Posts';
                $data['links'] = $links;

                return view('admin.posts', $data);
                break;
        }
    }

    // CRUD operations for categories
    public function categories(Request $req, $type = '', $id = ''){
        switch ($type) {
            case 'add':
                // Add new category
                if($req->method() == 'POST'){
                    $category = new Category();
                    $validated = $req->validate([
                        'category' => 'required|string'
                    ]);

                    $data['category'] = $req->input('category'); 
                    $data['created_At'] = date("Y-m-d H:i:s");
                    $data['updated_at'] =  date("Y-m-d H:i:s");
                    
                    $category->insert($data);

                    return redirect('admin/categories');
                }
                return view('admin.add_category',['page_title'=> 'New Category']);
                break;

            case 'edit':
                // Edit category
                $category = new Category();
                
                if($req->method() == 'POST'){
                    
                    $validated = $req->validate([
                        'category' => 'required|string',
                    ]);

                    $data['category'] = $req->input('category');
                    $data['updated_at'] = date("Y-m-d H:i:s");
                    
                    $category->where('id',$id)->update($data);

                    return redirect('admin/categories/edit/'.$id);
                }

                // Fetch category details for editing
                $row = $category->find($id);

                return view('admin.edit_category',[
                    'page_title'=> 'Edit Category',
                    'row'=> $row,
                ]);
                break;

            case 'delete':
                // Delete category
                $category = new Category();
                $row = $category->find($id);
                
                if($req->method() == 'POST'){
                    $row->delete();
                    return redirect('admin/categories');
                }

                return view('admin.delete_category',[
                    'page_title'=> 'Delete Category',
                    'row'=> $row
                ]);
                break;

            default:
                // Fetch all categories
                $limit = 10;
                $page = $req->input('page') ? (int)$req->input('page') : 1;
                $offset = ($page - 1) * $limit;
                $page_class = new MyPage();
                $links = $page_class->make_links($req->fullUrlWithQuery(['page' => $page]), $page,1);
                
                $query = "SELECT * FROM categories ORDER BY id desc limit $limit offset $offset";
                $rows = DB::select($query);
                $data['rows'] = $rows;
                $data['page_title'] = 'Categories';
                $data['links'] = $links;

                return view('admin.categories', $data);
                break;
        }
    }

    // CRUD operations for users
    public function users(Request $req, $type = '', $id = ''){
        switch ($type) {
            case 'edit':
                // Edit user
                $user = new User();
                
                if($req->method() == 'POST'){
                    
                    $validated = $req->validate([
                        'name' => 'required|string',
                        'email' => 'required|email',
                    ]);

                    $data['name'] = $req->input('name');
                    $data['email'] = $req->input('email');

                    if(!empty($req->input('password'))){
                        $data['password'] = $req->input('password');
                    }
                    $data['updated_at'] = date("Y-m-d H:i:s");
                    
                    $user->where('id',$id)->update($data);

                    return redirect('admin/users/edit/'.$id);
                }

                // Fetch user details for editing
                $row = $user->find($id);

                return view('admin.edit_user',[
                    'page_title'=> 'Edit User',
                    'row'=> $row,
                ]);
                break;

            case 'delete':
                // Delete user
                $user = new User();
                $row = $user->find($id);
                
                if($req->method() == 'POST'){
                    if($row->id != 1){
                        $row->delete();
                    }
                    return redirect('admin/users');
                }

                return view('admin.delete_user',[
                    'page_title'=> 'Delete User',
                    'row'=> $row
                ]);
                break;

            default:
                // Fetch all users
                $limit = 10;
                $page = $req->input('page') ? (int)$req->input('page') : 1;
                $offset = ($page - 1) * $limit;
                $page_class = new MyPage();
                $links = $page_class->make_links($req->fullUrlWithQuery(['page' => $page]), $page,1);
                
                $query = "SELECT * FROM users ORDER BY id desc limit $limit offset $offset";
                $rows = DB::select($query);
                $data['rows'] = $rows;
                $data['page_title'] = 'Users';
                $data['links'] = $links;

                return view('admin.users', $data);
                break;
        }
    }

    // Save method
    public function save(Request $req){
        $validate = $req->validate([
            'key'=> 'required|string',
            'key'=> 'required|image'
        ]);
        return view('view');
    }
}