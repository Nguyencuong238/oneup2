<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! auth()->user()->can('organizations.view')) {
            abort(403);
        }

        $organizations = Organization::when(request('search'), function ($q) {
            $q->where('name', 'like', '%' . request('search') . '%');
        })
        ->paginate();

        return view('backend.organizations.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! auth()->user()->can('organizations.create')) {
            abort(403);
        }

        return view('backend.organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('organizations.create')) {
            abort(403);
        }

        $request->validate([
            'name'  => ['required'],
        ]);

        $organization = Organization::create([
            'name'   => request('name'),
            'slug'   => Str::slug(request('name')),
            'website'    => request('website'),
            'industry'  => request('industry'),
            'size'  => request('size'),
            'created_by'  => auth()->id(),
        ]);

        $organization
            ->addFromMediaLibraryRequest($request->media)
            ->toMediaCollection('media');

        flash(__('Record ":model" created', ['model' => $organization->name]), 'success');

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! auth()->user()->can('organizations.edit')) {
            abort(403);
        }

        $organization = Organization::findOrFail($id);

        return view('backend.organizations.edit', compact('organization'));
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

        if (! auth()->user()->can('organizations.edit')) {
            abort(403);
        }

        $organization = Organization::findOrFail($id);

        $request->validate([
            'name'  => ['required'],
        ]);

        $organization->fill([
            'name'   => request('name'),
            'slug'   => Str::slug(request('name')),
            'website'    => request('website'),
            'industry'  => request('industry'),
            'size'  => request('size'),
        ])->save();

        $organization
            ->addFromMediaLibraryRequest($request->media)
            ->toMediaCollection('media');

        flash(__('Record ":model" updated', ['model' => $organization->name]), 'success');

        return redirect()->route('organizations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! auth()->user()->can('organizations.delete')) {
            abort(403);
        }

        $organization = Organization::findOrFail($id);

        $organization->delete();

        flash(__('Record ":model" deleted', ['model' => $organization->title]), 'success');

        return redirect()->back();
    }

    public function search(Request $request)
    {
        if ($request->filled('id')) {
            $ids = explode(',', $request->id);

            return Organization::whereIn('id', $ids)
                ->select('id', 'title as text')
                ->get();
        }
        return Organization::where('title', 'like', '%'.$request->query('q').'%')
            ->select('id', 'title as text')
            ->paginate();
    }
}
