<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Sv_clubs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{










    public function index()
    {

            $users = User::get();
            return view('admin.role-permission.user.index', ['users' => $users]);
     }

    public function create()
    {
            $clubs = Sv_clubs::pluck('cid', 'name');
            $roles = Role::pluck('id', 'name');
            return view('admin.role-permission.user.create', ['roles' => $roles,'clubs'=>$clubs]);
     }

    public function store(Request $request)
    {

            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:8|max:20',
                'roles' => 'required'
            ]);

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'clubid' => $request->clubid,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->syncRoles($request->roles);
//      $m =  $user->roles()->sync($request->roles);
//      dd($m);
            return redirect(route('admin.users.index'))->with('status', 'User created successfully with roles');
     }

    public function edit(User $user)
    {
            $clubs = Sv_clubs::pluck('cid', 'name');
            $roles = Role::pluck('name', 'name')->all();
            $userRoles = $user->roles->pluck('name', 'name')->all();
            return view('admin.role-permission.user.edit', [
                'user' => $user,
                'roles' => $roles,
                'userRoles' => $userRoles,
                'clubs'=>$clubs
            ]);
     }

    public function update(Request $request, User $user)
    {

            $request->validate([
                'name' => 'required|string|max:255',
                 'username' => 'required|string|max:255',
                'password' => 'nullable|string|min:8|max:20',
                'roles' => 'required'
            ]);

            $data = [
                'username' => $request->username,
                'clubid' => $request->clubid,
                'name' => $request->name,
                'email' => $request->email,
            ];

            if (!empty($request->password)) {
                $data += [
                    'password' => Hash::make($request->password),
                ];
            }

            $user->update($data);
            $user->syncRoles($request->roles);

            return redirect(route('admin.users.index'))->with('success', __('lang.User Updated Successfully with roles'));
     }

    public function destroy($userId)
    {

        $user = User::findOrFail($userId);
        $user->delete();
        return redirect(route('admin.users.index'))->with('error', __('lang.User Deleted Successfully'));

    }
}
