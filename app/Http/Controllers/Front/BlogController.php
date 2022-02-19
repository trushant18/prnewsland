<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\News;

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

    public function getNewsList()
    {
        $news_list = News::where('status', 1)->paginate(12);
        return view('front.news.all', compact('news_list'));
    }

    public function getNewsDetails($slug)
    {
        $news = News::where('slug', $slug)->where('status', 1)->first();
        if (is_null($news)){
            return redirect()->route('home');
        }
        return view('front.news.single', compact('news'));
    }
}
