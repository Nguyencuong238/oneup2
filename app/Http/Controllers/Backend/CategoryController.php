<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! auth()->user()->can('categories.view')) {
            abort(403);
        }

        $categories = Category::when(request('search'), function ($q) {
            $q->where('name', 'like', '%' . request('search') . '%');
        })->paginate();

        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! auth()->user()->can('categories.create')) {
            abort(403);
        }

        $parentCategories = Category::with(['ancestors' => function ($q) {
            $q->breadthFirst();
        }])->get();

        return view('backend.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('categories.create')) {
            abort(403);
        }

        $request->validate([
            'name'      => ['required'],
            'parent_id' => ['nullable'],
            'type'      => ['required'],
        ]);

        $category = Category::create([
            'name'      => request('name'),
            'parent_id' => request('parent_id') == 'root' ? null : request('parent_id'),
            'type'      => request('type'),
            // 'external_link' => request('external_link') ?? 0,
            // 'link' => request('link'),
            // 'meta'        => [
            //     'meta_title'       => request('meta_title'),
            //     'meta_description' => request('meta_description'),
            // ],
            'slug' => request('slug')
        ]);

        flash(__('Record ":model" created', ['model' => $category->name]), 'success');

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
        if (! auth()->user()->can('categories.edit')) {
            abort(403);
        }

        $category = Category::findOrFail($id);

        $parentCategories = Category::where('id', '<>', $id)->with(['ancestors' => function ($q) {
            $q->breadthFirst();
        }])->get();

        return view('backend.categories.edit', compact('parentCategories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! auth()->user()->can('categories.edit')) {
            abort(403);
        }
        $category = Category::findOrFail($id);

        $request->validate([
            'name'      => ['required'],
            'parent_id' => ['nullable'],
        ]);

        $category->fill([
            'name'      => request('name'),
            'parent_id' => request('parent_id') == 'root' ? null : request('parent_id'),
            // 'external_link' => request('external_link') ?? 0,
            // 'link' => request('link'),
            // 'meta'        => [
            //     'meta_title'       => request('meta_title'),
            //     'meta_description' => request('meta_description'),
            // ],
            'slug' => request('slug')
        ])->save();


        flash(__('Record ":model" updated', ['model' => $category->name]), 'success');

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
        if (! auth()->user()->can('categories.delete')) {
            abort(403);
        }

        $category = Category::findOrFail($id);

        $category->descendants()->update(['parent_id' => null]);

        $category->delete();

        flash(__('Record ":model" deleted', ['model' => $category->name]), 'success');

        return redirect()->back();
    }
}
