<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Plan;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('front.home.index');
    }

    public function getPageDetails($page_type)
    {
        if (!in_array($page_type, array_keys(Page::PAGE_TYPES))){
            return redirect()->route('home');
        }
        $pageDetails = Page::where('type', $page_type)->first();
        if(isset($pageDetails)){
            return view('front.page_content', compact('page_type', 'pageDetails'));
        }else{
            return redirect()->route('home');
        }
    }

    public function getPricingList()
    {
        $items = Plan::get();
        return view('front.pricing', compact('items'));
    }
}
