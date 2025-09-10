<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class ModulesController extends Controller
{


    public function index()
    {
        return view('admin.role-permission.modules.index' );
    }

    public function create()
    {
        return view('admin.role-permission.role.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        Role::create([
            'name' => $request->name
        ]);

        return redirect(route('admin.roles.index'))->with('status', __('lang.Role Created Successfully'));
    }

    public function edit(Role $role)

    {
        return view('admin.role-permission.role.edit', [
            'role' => $role
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $role->id
            ]
        ]);

        $role->update([
            'name' => $request->name
        ]);

        return redirect(route('admin.roles.index'))->with('status', __('lang.Role Updated Successfully'));
    }

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        return redirect(route('admin.roles.index'))->with('status', __('lang.Role Deleted Successfully'));
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('admin.role-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status', __('lang.Permissions added to role'));
    }


    public function giveModuleToRole(Request $request, $roleId)
    {
//       dd( checkModule('teachers'));
        //dd(checkModulePermission('teachers' , 'add_teacher'))
//        dd(checkUserHasRoleHasModule());
        $role = \App\Models\Role::findOrFail($roleId);
        $mods = [];
        $request->modules = ['mod_1' , 'mod_2'];
        foreach ($request->modules as $module) {
            $mods[] = RoleModule::create(['role_id' => $roleId, 'module_code' => $module]);
        }
        $m = $role->modules()->saveMany($mods);
    }

}
