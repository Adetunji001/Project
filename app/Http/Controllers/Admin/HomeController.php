<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;
use App\Models\BreakingNews;
use App\Models\Post;
use App\Models\Todo;

use Alert;





class HomeController extends Controller
{
    public function home(){

        return view('admin.home');
    }

    

    public function categories(){

        $categories = Category::get();
        return view('admin.categories', [ 
            'categories' => $categories

        ]);
    
        

    }

    public function addCategory(Request $request){
        $category = new Category();
        $category->category = $request->input("category");
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|unique:categories',
            
        ]);
        $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->input("title"))));
        if ($validator->fails()) {
            Alert::error('Oops!', 'Unsuccessful Submission')->persistent('Close');
            return redirect()->back();
        }

        $category->slug = $slug;
        if($category->save()){
            Alert::success('Success!','Category submitted successfully')->persistent('Close');
            return redirect()->back();
        };
        Alert::error('Oops!', 'Unsuccessful Submission')->persistent('Close');
    }

    public function updateCategory(Request $request){
        $category = Category::find($request->input('category_id'));
        $category->category = $request->input('category');
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|unique:categories',
            'category_id' => 'required',
            
        ]);
        if ($validator->fails()) {
            Alert::error('Oops!', 'Failed to update category')->persistent('Close');
            return redirect()->back();
        }
        if(!$category = Category::find($request->input('category_id'))){
            Alert::error('Oops!', 'Category not found')->persistent('Close');
            return redirect()->back();
        }
        if($request->input('category') != $category->category){
            $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->input("category"))));
            $category->slug = $slug;
            $category->category = $request->input("category");
        }
        if($category->save()){
            Alert::success('Success!','Category updated successfully')->persistent('Close');
            return redirect()->back();
        }
    }
    public function deleteCategory(Request $request){
        $category = Category::find($request->input('category_id'));
        $category->category = $request->input('category');
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            
        ]);
        if ($validator->fails()) {
            Alert::error('Oops!', 'Failed to delete category')->persistent('Close');
            return redirect()->back();
        }
        if(!$category = Category::find($request->input('category_id'))){
            Alert::error('Oops!', 'Category not found')->persistent('Close');
            return redirect()->back();
        }
        if($request->input('category') != $category->category){
            $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->input("category"))));
            $category->slug = $slug;
            $category->category = $request->input("category");
        }
        if($category->forceDelete()){
            Alert::success('Success!','Category deleted successfully')->persistent('Close');
            return redirect()->back();
        }
    }
    // public function posts(){
    //     $posts = Post::all();
    //     $categories = Category::all();
    //     return (view ("admin.posts" , [
    //         "categories"=> $categories,
    //         "posts"=> $posts
    //     ]));
    // }
    // public function addPost(Request $request){
    //     $post = new Post();
    //     $post->title = $request->input("title");
    //     $post->description = $request->input("description");
    //     $post->post_body = $request->input("post_body");
    //     $post->category_id = $request->input("category_id");
    //     $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->input("title"))));
    //     $post->slug = $slug;
    //     $imageUrl = 'uploads/posts/'. $slug.'.'.$request->input(file('image'))->getClientOriginalExtension();
    //     $image = $request->input(file('image'))->move('uploads/posts',$imageUrl);
    //     $post->image = $image;
    //     $admin = Auth::guard('admin')->user();
    //     $post->admin_id = $admin->id;
    //     $validator = Validator::make($request->all(), [
    //         'title' => 'required|string|unique:posts',
    //         'description' => 'required|string',
    //         'post_body' => 'required|string',
    //         'category_id' => 'required|string',
    //         'admin_id'=> 'required|string',
    //         'image' => 'mimes:jpeg,jpg,png|required|max:10000'
    //     ]);
        
    //     if ($validator->fails()) {
    //         Alert::error('Oops!', 'Unsuccessful Submission')->persistent('Close');
    //         return redirect()->back();
    //     }

    //     if($post->save()){
    //         Alert::success('Success!','Post submitted successfully')->persistent('Close');
    //         return redirect()->back();
    //     };
    //     Alert::error('Oops!', 'Unsuccessful Submission')->persistent('Close');


        
    // }
    // public function bn(){
    //     return view("admin.bn");
    // }
    // public function newsletter(){
    //     return view("admin.newsletter");
    // }
    // public function users(){
    //     return view("admin.users");
    // }
    
    
    // public function addBN(Request $request){

    //     $BN = new BreakingNews();
    //     $BN->title = $request->input("breaking_news");
    //     $validator = Validator::make($request->all(), [
    //         'title' => 'required|string|unique:breaking_news',
            
    //     ]);
    //     if ($validator->fails()) {
    //         Alert::error('Oops!', 'Unsuccessful Submission')->persistent('Close');
    //         return redirect()->back();
    //     }
    //     Alert::success('Success!','Breaking News submitted successfully')->persistent('Close');
    //     $BN->save();
    //     return redirect()->back();
    // }

    


    public function todo(){

        $todo = Todo::get();
        return view('admin.todo', [ 
            'todo' => $todo

        ]);
    
        

    }

    public function addTodo(Request $request){
        $todo = new Todo();
        $todo->todo = $request->input("category");
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|unique:categories',
            
        ]);
        $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->input("title"))));
        if ($validator->fails()) {
            Alert::error('Oops!', 'Unsuccessful Submission')->persistent('Close');
            return redirect()->back();
        }

        $todo->slug = $slug;
        if($todo->save()){
            Alert::success('Success!','Category submitted successfully')->persistent('Close');
            return redirect()->back();
        };
        Alert::error('Oops!', 'Unsuccessful Submission')->persistent('Close');
    }

   

   public function updateTodo(Request $request){
        $todo = Todo::find($request->input('category_id'));
        $todo->todo = $request->input('category');
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|unique:categories',
            'category_id' => 'required',
            
        ]);
        if ($validator->fails()) {
            Alert::error('Oops!', 'Failed to update category')->persistent('Close');
            return redirect()->back();
        }
        if(!$todo = Todo::find($request->input('category_id'))){
            Alert::error('Oops!', 'Category not found')->persistent('Close');
            return redirect()->back();
        }
        if($request->input('category') != $todo->todo){
            $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->input("category"))));
            $todo->slug = $slug;
            $todo->todo = $request->input("category");
        }
        if($Todo->save()){
            Alert::success('Success!','Category updated successfully')->persistent('Close');
            return redirect()->back();
        }
    }
    public function deleteTodo(Request $request){
        $todo = Todo::find($request->input('category_id'));
        $todo->todo= $request->input('category');
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            
        ]);
        if ($validator->fails()) {
            Alert::error('Oops!', 'Failed to delete category')->persistent('Close');
            return redirect()->back();
        }
        if(!$todo = Todo::find($request->input('category_id'))){
            Alert::error('Oops!', 'Category not found')->persistent('Close');
            return redirect()->back();
        }
        if($request->input('category') != $todo->todo){
            $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->input("category"))));
            $todo->slug = $slug;
            $todo->todo = $request->input("category");
        }
        if($todo->forceDelete()){
            Alert::success('Success!','Category deleted successfully')->persistent('Close');
            return redirect()->back();
        }
    }

    


    

    
   


   


    public function blogposts(){

        $blogposts = Post::get();
        return view('admin.blogposts', [ 
            'blogposts' => $blogposts

        ]);
    
        

    }

    public function addPost(Request $request){
        $post = new Post();
        $post->post = $request->input("category");
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|unique:categories',
            
        ]);
        $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->input("title"))));
        if ($validator->fails()) {
            Alert::error('Oops!', 'Unsuccessful Submission')->persistent('Close');
            return redirect()->back();
        }

        $post->slug = $slug;
        if($post->save()){
            Alert::success('Success!','Category submitted successfully')->persistent('Close');
            return redirect()->back();
        };
        Alert::error('Oops!', 'Unsuccessful Submission')->persistent('Close');
    }

    public function updatePost(Request $request){
        $post = Post::find($request->input('category_id'));
        $post->post = $request->input('category');
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|unique:categories',
            'category_id' => 'required',
            
        ]);
        if ($validator->fails()) {
            Alert::error('Oops!', 'Failed to update category')->persistent('Close');
            return redirect()->back();
        }
        if(!$post = Post::find($request->input('category_id'))){
            Alert::error('Oops!', 'Category not found')->persistent('Close');
            return redirect()->back();
        }
        if($request->input('category') != $post->post){
            $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->input("category"))));
            $post->slug = $slug;
            $post->post = $request->input("category");
        }
        if($post->save()){
            Alert::success('Success!','Post updated successfully')->persistent('Close');
            return redirect()->back();
        }
    }
    public function deletePost(Request $request){
        $post = Post::find($request->input('category_id'));
        $post->post = $request->input('category');
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            
        ]);
        if ($validator->fails()) {
            Alert::error('Oops!', 'Failed to delete category')->persistent('Close');
            return redirect()->back();
        }
        if(!$post = Post::find($request->input('category_id'))){
            Alert::error('Oops!', 'Post not found')->persistent('Close');
            return redirect()->back();
        }
        if($request->input('category') != $post->post){
            $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->input("category"))));
            $post->slug = $slug;
            $post->post = $request->input("category");
        }
        if($post->forceDelete()){
            Alert::success('Success!','Post deleted successfully')->persistent('Close');
            return redirect()->back();
        }
    }

   
    
    
    

    
    




    // public function blogposts(){

    //     return view('admin.blogposts');
    // }

    // public function breakingnews(){

    //     return view('admin.breakingnews');
    // }

    // public function newsletters(){

    //     return view('admin.newsletters');
    // }

    // public function users(){

    //     return view('admin.users');
    // }

    // public function logout(){

    //     return view('admin.logout');
    // }
}
