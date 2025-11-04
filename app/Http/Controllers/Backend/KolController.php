<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Kol;
use App\Models\User;
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
            ->paginate();

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

        // $categories = Category::where('type', 'kols')->tree()->get()->toTree();
        $categories = Category::where('type', 'kols')->get();


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

        $request->validate([
            'username'          => 'required|string|max:255|unique:kols,username',
            'display_name'      => 'required|string|max:255',
            
        ]);

        $kol = Kol::create([
            'platform'       => request('platform'),
            'username'          => request('username'),
            'display_name'      => request('display_name'),
            'bio'               => request('bio'),
            'location_country'  => request('location_country'),
            'location_city'     => request('location_city'),
            'language'          => request('language'),
            'is_verified'       => request('is_verified'),
            'is_featured'       => request('is_featured'),
            'blue_tick'       => request('blue_tick'),
            'status'            => request('status'),
            'tier'              => request('tier'),
            'followers'         => request('followers'),
            'trust_score'       => request('trust_score'),
            'engagement'        => request('engagement'),
            'price_tiktok'      => request('price_tiktok'),
            'price_campaign'    => request('price_campaign')
        ]);

        $kol
            ->addFromMediaLibraryRequest($request->media)
            ->toMediaCollection('media');


        $kol->categories()->sync(request('categories'));

        User::create([
            'name'      => $kol->display_name,
            'email'     => $kol->username . '@gmail.com',
            'password'  => bcrypt('12344321'),
            'type'      => 'kols',
            'kol_id'    => $kol->id,
        ]);

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
            'platform'       => request('platform'),
            'username'          => request('username'),
            'display_name'      => request('display_name'),
            'bio'               => request('bio'),
            'location_country'  => request('location_country'),
            'location_city'     => request('location_city'),
            'language'          => request('language'),
            'is_verified'       => request('is_verified'),
            'is_featured'       => request('is_featured'),
            'blue_tick'         => request('blue_tick'),
            'status'            => request('status'),
            'tier'              => request('tier'),
            'followers'         => request('followers'),
            'trust_score'       => request('trust_score'),
            'engagement'        => request('engagement'),
            'price_tiktok'      => request('price_tiktok'),
            'price_campaign'    => request('price_campaign')
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
