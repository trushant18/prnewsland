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
        $price = 0;
        return view('user.news_form', compact('user', 'paid_news', 'price'));
    }

    public function newsCreateFormPaid($plan_id)
    {
        $plan = Plan::findOrFail($plan_id);
        $user = auth()->user();
        $paid_news = true;
        $price = $plan->price;
        return view('user.news_form', compact('user', 'paid_news', 'price'));
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
        $news_list = News::where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(10);
        return view('user.press_releases', compact('user', 'news_list'));
    }

    public function myDraftReleases()
    {
        $user = auth()->user();
        $news_list = News::where('user_id', $user->id)->where('status', 3)->orderBy('id', 'DESC')->paginate(10);
        return view('user.draft_releases', compact('user', 'news_list'));
    }
}
