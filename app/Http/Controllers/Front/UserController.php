<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Kol;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function kolExplorer()
    {
        $kols = Kol::where('status', 'active')->get();
        $categories = Category::where('type', 'kols')->get();

        return view('user.kol_explorer', compact('kols', 'categories'));
    }

    public function campaign()
    {
        return view('user.campaign');
    }

    public function campaignDetail($slug)
    {
        return view('user.campaign_detail');
    }

    public function campaignTracker($slug)
    {
        return view('user.campaign_tracker');
    }

    public function analytic()
    {
        return view('user.analytic');
    }

    public function report()
    {
        return view('user.report');
    }

    public function setting()
    {
        return view('user.setting');
    }

    public function billing()
    {
        return view('user.billing');
    }

    public function kolProfile()
    {
        return view('user.kol_profile');
    }

    public function leaderboard()
    {
        return view('user.leaderboard');
    }
}
