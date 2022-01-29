<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewsApprovedMailToUserEvent;
use App\Events\NewsRejectedMailToUserEvent;
use App\Http\Controllers\Controller;
use App\Interfaces\BlogRepositoryInterface;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index()
    {
        $news_list = News::orderBy('id', 'DESC')->get();
        return view('admin.news.index', compact('news_list'));
    }

    public function details($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.view', compact('news'));
    }

    public function approve($id): \Illuminate\Http\RedirectResponse
    {
        $news = News::findOrFail($id);
        $news->status = 1;
        $news->save();

        event(new NewsApprovedMailToUserEvent($news));
        return redirect()->route('admin.news')->with('success', 'News Request Approved.');
    }

    public function reject(Request $request): \Illuminate\Http\RedirectResponse
    {
        $requestData = $request->all();
        $news = News::findOrFail($requestData['news_id']);
        $news->status = 2;
        $news->reject_reason = $requestData['reason'];
        $news->save();

        event(new NewsRejectedMailToUserEvent($news));
        return redirect()->route('admin.news')->with('success', 'News Request Rejected.');
    }
}