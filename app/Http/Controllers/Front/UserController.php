<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard() 
    {
        return view('user.dashboard');
    }
    
    public function kolExplorer() 
    {
        return view('user.kol_explorer');
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
