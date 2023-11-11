<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){

        return view('admin.home');
    }

    public function categories(){

        return view('admin.categories');
    }

    public function blogposts(){

        return view('admin.blogposts');
    }

    public function breakingnews(){

        return view('admin.breakingnews');
    }

    public function newsletters(){

        return view('admin.newsletters');
    }

    public function users(){

        return view('admin.users');
    }

    public function logout(){

        return view('admin.logout');
    }
}
