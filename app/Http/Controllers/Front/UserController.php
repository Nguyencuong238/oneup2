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
        $kols = Kol::where('status', 'active')
            ->when(request('categories'), function($q) {
                $q->whereHas('categories', function($sub) {
                    $sub->whereIn('id', request('categories'));
                });
            })
            ->when(request('followers'), function($q) {
                $q->where('followers', '>=', request('followers'));
            })
            ->when(request('engagement'), function($q) {
                $q->where('engagement', '>=', request('engagement'));
            })
            ->when(request('trust_score'), function($q) {
                $q->where('trust_score', '>=', request('trust_score'));
            })
            ->when(request('sortBy'), function($q) {
                $q->orderBy(request('sortBy'));
            })
            ->paginate(12);

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

    public function kolProfile($id)
    {
        $kol = Kol::find($id);

        return view('user.kol_profile', compact('kol'));
    }

    public function leaderboard()
    {
        return view('user.leaderboard');
    }
}
