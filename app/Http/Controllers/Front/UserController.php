<?php

namespace App\Http\Controllers\Front;

use App\Events\NewsApprovalMailToAdminEvent;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
    }

    public function getProfile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = auth()->user();
        $requestData = $request->all();
        if (isset($requestData['image'])) {
            $file = $requestData['image'];
            $uploadPath = storage_path(User::IMG_PATH);
            if (isset($user->image)) {
                $imagePath = $uploadPath . $user->image;
                @unlink($imagePath);
            }
            $extension = $file->getClientOriginalExtension();
            $requestData['image'] = rand(11111, 99999) . '.' . $extension;
            $file->move($uploadPath, $requestData['image']);
        }
        $user->update($requestData);
        return redirect()->route('user.profile')->with('success', 'Profile Updated Successfully!');
    }

    public function updatePassword(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = auth()->user();
        $requestData = $request->all();
        if (password_verify($requestData['old_password'], $user->password)) {
            $user->password = bcrypt($requestData['password']);
            $user->save();
            return redirect()->back()->with(['success' => "Password updated successfully."]);
        }
        return redirect()->back()->with(['error' => "Your Current Password is Wrong..!!"]);
    }

    public function newsCreateForm()
    {
        $user = auth()->user();
        $paid_news = false;
        $plan_id = null;
        return view('user.news_form', compact('user', 'paid_news', 'plan_id'));
    }

    public function newsCreateFormPaid($plan_id)
    {
        $plan = Plan::findOrFail($plan_id);
        $user = auth()->user();
        $paid_news = true;
        $plan_id = $plan->id;
        return view('user.news_form', compact('user', 'paid_news', 'plan_id'));
    }

    public function storeNews(Request $request): string
    {
        $requestData = $request->all();
        if ($requestData['button'] == 'submit') {
            $this->validate($request, [
                'category' => 'required',
                'title' => 'required',
                'slug' => 'required|unique:news,slug',
                'content' => 'required',
                'image' => 'required',
                'city' => 'required',
                'country' => 'required',
            ]);
        } else {
            $requestData['status'] = 3;
        }
        if ($requestData['is_free'] == 0){
            $requestData['status'] = 3;
        }
        $user = auth()->user();
        $requestData['user_id'] = $user->id;
        if (isset($requestData['image'])) {
            $file = $requestData['image'];
            $uploadPath = storage_path(News::IMG_PATH);
            $extension = $file->getClientOriginalExtension();
            $requestData['image'] = rand(11111, 99999) . '.' . $extension;
            $file->move($uploadPath, $requestData['image']);
        }
        $news = News::create($requestData);
        if ($news->is_free == 0){
            return redirect()->route('paidNewsForm', $news->id);
        }
        if ($news->status != 3) {
            $emailData = [
                'user_name' => ucfirst($user->first_name) . ' ' . $user->last_name,
                'news_title' => $requestData['title'],
            ];
            event(new NewsApprovalMailToAdminEvent($emailData));
            return redirect()->route('user.press_releases');
        } else {
            return redirect()->route('user.draft_releases');
        }
    }

    public function myPressReleases()
    {
        $user = auth()->user();
        $news_list = News::where('user_id', $user->id)->where('status', '!=',  3)->orderBy('id', 'DESC')->paginate(10);
        return view('user.press_releases', compact('user', 'news_list'));
    }

    public function myDraftReleases()
    {
        $user = auth()->user();
        $news_list = News::where('user_id', $user->id)->where('status', 3)->orderBy('id', 'DESC')->paginate(10);
        return view('user.draft_releases', compact('user', 'news_list'));
    }

    public function editNews($id)
    {
        $user = auth()->user();
        $news = News::where('id', $id)->where('user_id', $user->id)->first();
        if (isset($news)){
            return view('user.edit_news_form', compact('news'));
        }else{
            return redirect()->back()->with('error', 'Invalid Request!');
        }
    }

    public function publishNews($id)
    {
        $user = auth()->user();
        $news = News::where('id', $id)->where('user_id', $user->id)->first();
        if (isset($news) && isset($news->title) && isset($news->category) &&
            isset($news->city) && isset($news->country) && isset($news->content) && isset($news->image)){
            $news->update(['status' => 0]);
            $emailData = [
                'user_name' => ucfirst($user->first_name) . ' ' . $user->last_name,
                'news_title' => $news->title,
            ];
            event(new NewsApprovalMailToAdminEvent($emailData));
            return redirect()->route('user.press_releases')->with('success', 'Publish Successfully.');
        }else{
            return redirect()->back()->with('error', 'Please update all news related details.');
        }
    }

    public function updateNews(Request $request, $id)
    {
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required',
            'content' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);
        $requestData = $request->all();
        $user = auth()->user();
        $news = News::where('id', $id)->where('user_id', $user->id)->first();
        if (isset($news)){
            if (isset($requestData['image'])) {
                $file = $requestData['image'];
                $uploadPath = storage_path(News::IMG_PATH);
                if (isset($news->image)){
                    $imagePath = $uploadPath . $news->image;
                    @unlink($imagePath);
                }
                $extension = $file->getClientOriginalExtension();
                $requestData['image'] = rand(11111, 99999) . '.' . $extension;
                $file->move($uploadPath, $requestData['image']);
            }
            $news->update($requestData);
            return redirect()->route('user.draft_releases')->with('success', 'Updated Successfully.');
        }
        return redirect()->back()->with('error', 'Invalid Request!');
    }
}
