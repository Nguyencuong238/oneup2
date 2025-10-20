<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Kol;
use Illuminate\Http\Request;

class KolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kols = Kol::query()
            ->latest()
            ->with('categories')
            ->when(request('search'), function ($q) {
                $q->where('title', 'like', '%' . request('search') . '%');
            })
            ->when(request('category'), function ($q) {
                $q->whereHas('categories', function ($q) {
                    $q->where('slug', request('category'));
                });
            })
            ->take()
            ->get();

        return view('backend.kols.index', compact('kols'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (! auth()->user()->can('kols.create')) {
        //     abort(403);
        // }

        $categories = Category::where('type', 'kols')->tree()->get()->toTree();


        return view('backend.kols.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (! auth()->user()->can('kols.create')) {
        //     abort(403);
        // }

        $kol = Kol::create([
            'platform_id'       => request('platform_id'),
            'username'          => request('username'),
            'display_name'      => request('display_name'),
            'bio'               => request('bio'),
            'location_country'  => request('location_country'),
            'location_city'     => request('location_city'),
            'language'          => request('language'),
            'is_verified'       => request('is_verified'),
            'status'            => request('status'),
            'tier'              => request('tier'),
            'followers'         => request('followers'),
            'trust_score'       => request('trust_score'),
            'engagement'        => request('engagement'),
            'price'             => request('price')
        ]);

        $kol
            ->addFromMediaLibraryRequest($request->media)
            ->toMediaCollection('media');


        $kol->categories()->sync(request('categories'));


        flash(__('Tạo thành công'), 'success');

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
        // if (! auth()->user()->can('kols.edit')) {
        //     abort(403);
        // }


        $kol = Kol::with('media')->findOrFail($id);

        $categories = Category::where('type', 'kols')->tree()->get()->toTree();

        return view('backend.kols.edit', compact('categories', 'kol'));
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
        // if (! auth()->user()->can('kols.edit')) {
        //     abort(403);
        // }

        $kol = Kol::findOrFail($id);

        $kol->fill([
            'platform_id'       => request('platform_id'),
            'username'          => request('username'),
            'display_name'      => request('display_name'),
            'bio'               => request('bio'),
            'location_country'  => request('location_country'),
            'location_city'     => request('location_city'),
            'language'          => request('language'),
            'is_verified'       => request('is_verified'),
            'status'            => request('status'),
            'tier'              => request('tier'),
            'followers'         => request('followers'),
            'trust_score'       => request('trust_score'),
            'engagement'        => request('engagement'),
            'price'             => request('price')
        ])->save();

        $kol
            ->syncFromMediaLibraryRequest($request->media)
            ->toMediaCollection('media');

        $kol->categories()->sync(request('categories'));

        flash(__('Cập nhật thành công'), 'success');

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
        // if (! auth()->user()->can('kols.delete')) {
        //     abort(403);
        // }

        $kol = Kol::findOrFail($id);

        $kol->delete();

        $kol->categories()->sync([]);

        flash(__('Record ":model" deleted', ['model' => $kol->name]), 'success');

        return redirect()->back();
    }

    public function search(Request $request)
    {
        if ($request->filled('id')) {
            $ids = explode(',', $request->id);

            return Kol::whereIn('id', $ids)
                ->select('id', 'title as text')
                ->get();
        }
        return Kol::where('title', 'like', '%' . $request->query('q') . '%')
            ->select('id', 'title as text')
            ->paginate();
    }
}
