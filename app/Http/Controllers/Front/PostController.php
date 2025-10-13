<?php

namespace App\Http\Controllers\Front;

use App\Events\PostView;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Post;
use Illuminate\Session\Store;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
        ->with('media', 'author:id,name')
        ->latest()
        ->when(request('search'), function ($q) {
            $q->where('title', 'like', '%' . request('search') . '%');
        })->paginate();
       
        return view('front.posts.index', compact('posts'));
    }

    public function show($slug, Store $session)
    {
        $post = Post::where('slug', $slug)->with('media')->firstOrFail();

        $categories = $post->categories()->get()->pluck('id')->toArray();

        $otherPost = Post::whereHas('categories', function ($q) use ($categories) {
            $q->whereIn('id', $categories);
        })->inRandomOrder()->with('media')->take(6)->get();

        PostView::dispatch($post);
        
        $recentPosts = $session->get('recent_posts', []);
        if(isset($recentPosts['post_' . $post->id])) {
            unset($recentPosts['post_' . $post->id]);
        }
        $recentPosts['post_' . $post->id] = $post;
        if(count($recentPosts) > 5) {
            array_shift($recentPosts);
        }

        $session->put('recent_posts', $recentPosts);

        return view('front.posts.show', compact('post', 'otherPost'));
    }
}
