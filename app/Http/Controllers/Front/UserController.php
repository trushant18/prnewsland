<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\News;
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
        if (isset($requestData['image'])){
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
        return view('user.news_form', compact('user'));
    }

    public function storeNews(Request $request)
    {
        $requestData = $request->all();
        $user = auth()->user();
        $requestData['user_id'] = $user->id;
        if (isset($requestData['image'])){
            $file = $requestData['image'];
            $uploadPath = storage_path(User::IMG_PATH);
            $extension = $file->getClientOriginalExtension();
            $requestData['image'] = rand(11111, 99999) . '.' . $extension;
            $file->move($uploadPath, $requestData['image']);
        }
        News::crete($requestData);
        return route('user.press_releases');
    }

    public function myDraftReleases()
    {
        $user = auth()->user();
        return view('user.draft_releases', compact('user'));
    }

    public function myPressReleases()
    {
        $user = auth()->user();
        return view('user.press_releases', compact('user'));
    }
}
