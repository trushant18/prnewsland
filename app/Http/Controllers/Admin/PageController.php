<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidatePages;
use App\Interfaces\PageRepositoryInterface;

class PageController extends Controller
{
    protected $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function index()
    {
        $pages = $this->pageRepository->getAllPages();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $page_types = $this->pageRepository->getPageTypes();
        return view('admin.pages.create', compact('page_types'));
    }

    public function store(ValidatePages $request)
    {
        $this->pageRepository->storePage($request);
        return redirect()->route('admin.pages')->with('success', 'Data Created Successfully.');
    }

    public function edit($id)
    {
        $page = $this->pageRepository->getPageDetails($id);
        $page_types = $this->pageRepository->getPageTypes($id);
        return view('admin.pages.edit', compact('page', 'page_types'));
    }

    public function update(ValidatePages $request, $id)
    {
        $this->pageRepository->updatePage($request, $id);
        return redirect()->route('admin.pages')->with('success', 'Data Updated Successfully.');
    }

    public function delete($id)
    {
        $this->pageRepository->deletePage($id);
        return redirect()->route('admin.pages')->with('success', 'Data Deleted Successfully.');
    }
}