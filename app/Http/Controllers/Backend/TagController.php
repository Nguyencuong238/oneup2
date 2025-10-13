<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! auth()->user()->can('tags.view')) {
            abort(403);
        }

        $tags = Tag::paginate();

        return view('backend.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! auth()->user()->can('tags.create')) {
            abort(403);
        }

        return view('backend.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('tags.create')) {
            abort(403);
        }

        $request->validate([
            'name' => ['required'],
            'type' => ['required'],
        ]);

        $tag = Tag::create([
            'name' => request('name'),
            'type' => request('type'),
        ]);

        flash(__('Record ":model" created', ['model' => $tag->name]), 'success');

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
        if (! auth()->user()->can('tags.edit')) {
            abort(403);
        }

        $tag = Tag::findOrFail($id);

        return view('backend.tags.edit', compact('tag'));
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
        if (! auth()->user()->can('tags.edit')) {
            abort(403);
        }

        $tag = Tag::findOrFail($id);

        $request->validate([
            'name' => ['required'],
        ]);

        $tag->fill([
            'name' => request('name'),
        ])->save();

        flash(__('Record ":model" updated', ['model' => $tag->name]), 'success');

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
        if (! auth()->user()->can('tags.delete')) {
            abort(403);
        }

        $tag = Tag::findOrFail($id);

        $tag->delete();

        flash(__('Record ":model" deleted', ['model' => $tag->name]), 'success');

        return redirect()->back();
    }
}
