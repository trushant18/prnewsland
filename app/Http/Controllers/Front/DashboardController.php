<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Plan;

class DashboardController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $plans  = Plan::get();
        return view('user.dashboard', compact('plans'));
    }
}
