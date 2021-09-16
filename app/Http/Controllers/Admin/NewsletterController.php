<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendNewsletterEmailJob;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        return view('admin.newsletter.form');
    }

    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'content' => 'required',
        ]);
        $requestData = $request->except('_token');
        $job = (new SendNewsletterEmailJob($requestData))
            ->delay(now()->addSeconds(2));
        dispatch($job);
        return redirect()->back()->with('success', 'Newsletter send successfully.');
    }
}