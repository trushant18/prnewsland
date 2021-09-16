<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::get();
        return view('front.blogs.all', compact('blogs'));
    }

    public function getBlogDetails($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        if (is_null($blog)){
            return redirect()->route('home');
        }
        return view('front.blogs.single', compact('blog'));
    }
}
