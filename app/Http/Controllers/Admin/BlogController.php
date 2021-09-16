<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateBlogs;
use App\Interfaces\BlogRepositoryInterface;

class BlogController extends Controller
{
    protected $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index()
    {
        $blog_list = $this->blogRepository->getAllBlog();
        return view('admin.blog.index', compact('blog_list'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(ValidateBlogs $request)
    {
        $this->blogRepository->storeBlog($request);
        return redirect()->route('admin.blog')->with('success', 'Data Created Successfully.');
    }

    public function edit($id)
    {
        $blog = $this->blogRepository->getBlogDetails($id);
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(ValidateBlogs $request, $id)
    {
        $this->blogRepository->updateBlog($request, $id);
        return redirect()->route('admin.blog')->with('success', 'Data Updated Successfully.');
    }

    public function delete($id)
    {
        $this->blogRepository->deleteBlog($id);
        return redirect()->route('admin.pages')->with('success', 'Data Deleted Successfully.');
    }
}