<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewsApprovedMailToUserEvent;
use App\Events\NewsRejectedMailToUserEvent;
use App\Http\Controllers\Controller;
use App\Interfaces\BlogRepositoryInterface;
use App\Models\News;
use App\Models\Transaction;
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
        $news_list = News::where('status', '!=', 3)->orderBy('id', 'DESC')->get();
        return view('admin.news.index', compact('news_list'));
    }

    public function getPaymentHistory()
    {
        $history = Transaction::orderBy('id', 'DESC')->get();
        return view('admin.news.payment_history', compact('history'));
    }

    public function details($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.view', compact('news'));
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $news = News::findOrFail($id);
        if (isset($news)){
            if (isset($requestData['image'])) {
                $file = $requestData['image'];
                $uploadPath = storage_path(News::IMG_PATH);
                $extension = $file->getClientOriginalExtension();
                $requestData['image'] = rand(11111, 99999) . '.' . $extension;
                $file->move($uploadPath, $requestData['image']);
            }
            $news->update($requestData);
        }
        return redirect()->route('admin.news')->with('success', 'News Updated Successfully.');
    }

    public function delete($id)
    {
        News::where('id', $id)->delete();
        return redirect()->route('admin.news')->with('success', 'News Deleted Successfully.');
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