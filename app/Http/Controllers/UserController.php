<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Permission;
use App\Role;
use App\Traits\Authorizable;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        // return view('app.users.index', compact('dataTable'));
        return $dataTable->render('app.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        return view('app.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        $request->merge(['password' => bcrypt($request->get('password'))]);

        if ($user = User::create($request->except('roles', 'permissions'))) {
            $this->syncPermissions($request, $user);
            flash('User has been created');
        } else {
            flash()->error('Unable to create user');
        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('app.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        $permissions = Permission::all('name', 'id');

        return view('app.users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->fill($request->except('roles', 'permissions', 'password'));

        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }

        $this->syncPermissions($request, $user);

        if ($user->save()) {
            flash()->success('Berhasil mengubah user');
        } else {
            flash()->error('Gagal mengubah user');
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user()->id == $user->id) {
            flash()->warning('Deletion of currently logged in user is not allowed :(')->important();
            return redirect()->back();
        }

        if ($user->delete()) {
            flash()->success('Berhasil menghapus user');
        } else {
            flash()->error('Gagal menghapus user');
        }

        return redirect()->back();
    }

    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles and permissions
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for the current role changes
        if (!$user->hasAllRoles($roles)) {
            // reset all permission
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);

        return $user;
    }
}
