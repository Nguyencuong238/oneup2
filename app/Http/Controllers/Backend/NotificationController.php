<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Project;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! auth()->user()->can('notifications.view')) {
            abort(403);
        }

        $notifications = Notification::when(request('search'), function ($q) {
            $q->where('title', 'like', '%' . request('search') . '%');
        })
        ->paginate();

        return view('backend.notifications.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! auth()->user()->can('notifications.create')) {
            abort(403);
        }

        return view('backend.notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('notifications.create')) {
            abort(403);
        }

        $request->validate([
            'title'  => ['required'],
            'link'   => ['nullable'],
            'status' => ['nullable'],
        ]);

        $notification = Notification::create([
            'title'   => request('title'),
            'link'    => request('link'),
            'status'  => request('status'),
        ]);

        flash(__('Record ":model" created', ['model' => $notification->title]), 'success');

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
        if (! auth()->user()->can('notifications.edit')) {
            abort(403);
        }

        $notification = Notification::findOrFail($id);

        return view('backend.notifications.edit', compact('notification'));
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

        if (! auth()->user()->can('notifications.edit')) {
            abort(403);
        }

        $notification = Notification::findOrFail($id);

        $request->validate([
            'title'  => ['required'],
            'link'   => ['nullable'],
            'status' => ['nullable'],
        ]);

        $notification->fill([
            'title'   => request('title'),
            'link'    => request('link'),
            'status'  => request('status'),
        ])->save();

        flash(__('Record ":model" updated', ['model' => $notification->title]), 'success');

        return redirect()->route('notifications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! auth()->user()->can('notifications.delete')) {
            abort(403);
        }

        $notification = Notification::findOrFail($id);

        $notification->delete();

        flash(__('Record ":model" deleted', ['model' => $notification->title]), 'success');

        return redirect()->back();
    }

    public function search(Request $request)
    {
        if ($request->filled('id')) {
            $ids = explode(',', $request->id);

            return Notification::whereIn('id', $ids)
                ->select('id', 'title as text')
                ->get();
        }
        return Notification::where('title', 'like', '%'.$request->query('q').'%')
            ->select('id', 'title as text')
            ->paginate();
    }
}
