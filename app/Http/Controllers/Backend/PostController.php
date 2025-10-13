<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Post\Store;
use App\Http\Requests\Backend\Post\Update;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! auth()->user()->can('posts.view')) {
        //     abort(403);
        // }

        $posts = Post::query()
            ->latest()
            ->with('author', 'categories', 'tags')
            ->when(request('search'), function ($q) {
                $q->where('title', 'like', '%' . request('search') . '%')
                ->orWhereHas('author', function ($q) {
                    $q->where('name', 'like', '%' . request('search') . '%');
                });
            })
            ->when(request('category'), function ($q) {
                $q->whereHas('categories', function ($q) {
                    $q->where('slug', request('category'));
                });
            })
            ->when(request('author'), function ($q) {
                $q->whereHas('author', function ($q) {
                    $q->where('email', request('author'));
                });
            })
            ->when(request('tag'), function ($q) {
                $q->whereHas('tags', function ($q) {
                    $q->where('slug', request('tag'));
                });
            })
            ->paginate();

        return view('backend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (! auth()->user()->can('posts.create')) {
        //     abort(403);
        // }

        $categories = Category::where(function ($query) {
            $query->where('type', 'post')->orWhere('type', 'image')->orWhere('type', 'video');
        })->tree()->get()->toTree();


        $tags = Tag::whereType('post')->get();

        return view('backend.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        // if (! auth()->user()->can('posts.create')) {
        //     abort(403);
        // }

        $post = Post::create([
            'title'       => request('title'),
            'excerpt'     => request('excerpt'),
            'is_featured' => request('is_featured'),
            'body'        => request('body'),
            'meta'        => [
                'meta_title'       => request('meta_title'),
                'meta_description' => request('meta_description'),
            ],
            'author_id' => $request->user()->id,
            'slug' => request('slug')
        ]);

        $post
            ->addFromMediaLibraryRequest($request->media)
            ->toMediaCollection('media');

        // if ($request->filled('projects')) {
        //     $post->projects()->attach(request('projects'));
        // }

        $post->categories()->sync(request('categories'));

        $post->attachTags(request('tags'), 'post');

        flash(__('Record ":model" created', ['model' => $post->title]), 'success');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (! auth()->user()->can('posts.edit')) {
        //     abort(403);
        // }


        $post = Post::with('media')->findOrFail($id);

        $categories = Category::where('type', 'post')->tree()->get()->toTree();

        $tags = Tag::whereType('post')->get();

        return view('backend.posts.edit', compact('categories', 'tags', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id)
    {
        // if (! auth()->user()->can('posts.edit')) {
        //     abort(403);
        // }

        $post = Post::findOrFail($id);

        $post->fill([
            'title'       => request('title'),
            'excerpt'     => request('excerpt'),
            'is_featured' => request('is_featured'),
            'body'        => request('body'),
            'meta'        => [
                'meta_title'       => request('meta_title'),
                'meta_description' => request('meta_description'),
            ],
            'slug' => request('slug')
        ])->save();

        $post
            ->syncFromMediaLibraryRequest($request->media)
            ->toMediaCollection('media');

        // if ($request->filled('projects')) {
        //     $post->projects()->sync(request('projects'));
        // }

        $post->categories()->sync(request('categories'));

        $post->syncTagsWithType(request('tags'), 'post');

        flash(__('Record ":model" updated', ['model' => $post->title]), 'success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (! auth()->user()->can('posts.delete')) {
        //     abort(403);
        // }

        $post = Post::findOrFail($id);

        $post->delete();

        $post->categories()->sync([]);

        $post->tags()->sync([]);

        flash(__('Record ":model" deleted', ['model' => $post->name]), 'success');

        return redirect()->back();
    }

    public function search(Request $request)
    {
        if ($request->filled('id')) {
            $ids = explode(',', $request->id);

            return Post::whereIn('id', $ids)
                ->select('id', 'title as text')
                ->get();
        }
        return Post::where('title', 'like', '%'.$request->query('q').'%')
            ->select('id', 'title as text')
            ->paginate();
    }
}
