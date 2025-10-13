<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index()
    {
        $channelCount     = Post::count();
        $contactCount      = Tag::count();
        $categoryCount = Category::count();

        return view('backend.dashboard', compact('channelCount', 'contactCount', 'categoryCount'));
    }
}
