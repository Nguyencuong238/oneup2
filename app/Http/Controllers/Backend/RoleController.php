<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! auth()->user()->can('roles.view')) {
            abort(403);
        }

        $roles = Role::paginate();

        return view('backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! auth()->user()->can('roles.create')) {
            abort(403);
        }

        $permissions      = Permission::get();
        $groupPermissions = $permissions->groupBy(function ($permission) {
            [$group] = explode('.', $permission->name);

            return $group;
        });

        return view('backend.roles.create', compact('groupPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('roles.create')) {
            abort(403);
        }

        $request->validate([
            'name' => ['required'],
        ]);

        $role = Role::create([
            'name' => request('name'),
        ]);

        $allowPermissions = array_keys(array_filter($request->input('permissions'), function ($value) {
            return $value == 1;
        }));

        $role->givePermissionTo($allowPermissions);

        flash(__('Record ":model" created', ['model' => $role->name]), 'success');

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
        if (! auth()->user()->can('roles.edit')) {
            abort(403);
        }

        $role = Role::findOrFail($id);

        $allowPermissions = $role->getPermissionNames()->toArray();
        $permissions      = Permission::get();
        $groupPermissions = $permissions->groupBy(function ($permission) {
            [$group] = explode('.', $permission->name);

            return $group;
        });

        return view('backend.roles.edit', compact('role', 'groupPermissions', 'allowPermissions'));
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
        if (! auth()->user()->can('roles.edit')) {
            abort(403);
        }

        $role = Role::findOrFail($id);

        $request->validate([
            'name' => ['required'],
        ]);

        $role->fill([
            'name' => request('name'),
        ])->save();

        $allowPermissions = array_keys(array_filter($request->input('permissions'), function ($value) {
            return $value == 1;
        }));

        $role->syncPermissions($allowPermissions);

        flash(__('Record ":model" updated', ['model' => $role->name]), 'success');

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
        if (! auth()->user()->can('roles.delete')) {
            abort(403);
        }

        $role = Role::findOrFail($id);

        $role->delete();

        flash(__('Record ":model" deleted', ['model' => $role->name]), 'success');

        return redirect()->back();
    }
}
