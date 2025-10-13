<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! auth()->user()->can('users.view')) {
            abort(403);
        }

        $users = User::paginate();

        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! auth()->user()->can('users.create')) {
            abort(403);
        }

        $roles = Role::get();

        return view('backend.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('users.create')) {
            abort(403);
        }

        $request->validate([
            'email'    => ['required', 'email', 'string', 'max:255'],
            'name'     => ['required', 'string', 'max:255'],
            'password' => ['required', Password::default()],
            'roles'    => ['required'],
        ]);

        $user = User::create([
            'email'    => $request->email,
            'name'     => $request->name,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->roles);

        flash(__('Record ":model" created', ['model' => $user->name]), 'success');

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
        if (! auth()->user()->can('users.edit')) {
            abort(403);
        }

        $user = User::findOrFail($id);

        $roles = Role::get();

        return view('backend.users.edit', compact('roles', 'user'));
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
        if (! auth()->user()->can('users.edit')) {
            abort(403);
        }

        $user = User::findOrFail($id);

        $request->validate([
            'email'    => ['required', 'email', 'string', 'max:255'],
            'name'     => ['required', 'string', 'max:255'],
            'password' => ['nullable', Password::default()],
            'roles'    => ['required'],
        ]);

        $data = [
            'email' => $request->email,
            'name'  => $request->name,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->fill($data)->save();

        $user->syncRoles($request->roles);

        flash(__('Record ":model" updated', ['model' => $user->name]), 'success');

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
        if (! auth()->user()->can('users.delete')) {
            abort(403);
        }

        $user = User::findOrFail($id);

        $user->delete();

        flash(__('Record ":model" deleted', ['model' => $user->name]), 'success');

        return redirect()->back();
    }
}
