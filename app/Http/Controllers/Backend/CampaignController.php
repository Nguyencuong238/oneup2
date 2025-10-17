<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! auth()->user()->can('campaigns.view')) {
            abort(403);
        }

        $campaigns = Campaign::when(request('search'), function ($q) {
            $q->where('name', 'like', '%' . request('search') . '%');
        })
        ->paginate();

        return view('backend.campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! auth()->user()->can('campaigns.create')) {
            abort(403);
        }
        $organizations = Organization::all();
        
        return view('backend.campaigns.create', compact('organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('campaigns.create')) {
            abort(403);
        }

        $request->validate([
            'name'  => ['required'],
        ]);

        $campaign = Campaign::create([
            'organization_id' => request('organization_id'),
            'name' => request('name'),
            'description' => request('description'),
            'objective' => request('objective'),
            'budget_amount' => request('budget_amount'),
            'budget_currency' => request('budget_currency'),
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
            'target_reach' => request('target_reach'),
            'target_engagement' => request('target_engagement'),
            'target_conversions' => request('target_conversions'),
            'status' => request('status'),
            'created_by' => auth()->id()
        ]);

        flash(__('Record ":model" created', ['model' => $campaign->name]), 'success');

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
        if (! auth()->user()->can('campaigns.edit')) {
            abort(403);
        }

        $organizations = Organization::all();
        $campaign = Campaign::findOrFail($id);

        return view('backend.campaigns.edit', compact('campaign', 'organizations'));
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

        if (! auth()->user()->can('campaigns.edit')) {
            abort(403);
        }

        $campaign = Campaign::findOrFail($id);

        $request->validate([
            'name'  => ['required'],
        ]);

        $campaign->fill([
            'organization_id' => request('organization_id'),
            'name' => request('name'),
            'description' => request('description'),
            'objective' => request('objective'),
            'budget_amount' => request('budget_amount'),
            'budget_currency' => request('budget_currency'),
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
            'target_reach' => request('target_reach'),
            'target_engagement' => request('target_engagement'),
            'target_conversions' => request('target_conversions'),
            'status' => request('status'),
        ])->save();

        flash(__('Record ":model" updated', ['model' => $campaign->name]), 'success');

        return redirect()->route('campaigns.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! auth()->user()->can('campaigns.delete')) {
            abort(403);
        }

        $campaign = Campaign::findOrFail($id);

        $campaign->delete();

        flash(__('Record ":model" deleted', ['model' => $campaign->title]), 'success');

        return redirect()->back();
    }

    public function search(Request $request)
    {
        if ($request->filled('id')) {
            $ids = explode(',', $request->id);

            return Campaign::whereIn('id', $ids)
                ->select('id', 'title as text')
                ->get();
        }
        return Campaign::where('title', 'like', '%'.$request->query('q').'%')
            ->select('id', 'title as text')
            ->paginate();
    }
}
