<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleModule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function App\Http\Helpers\checkModule;
use function App\Http\Helpers\checkUserHasRoleHasModule;
use function App\Http\Helpers\getModules;

class RoleController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('permission:view role', ['only' => ['index']]);
//        $this->middleware('permission:create role', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
//        $this->middleware('permission:update role', ['only' => ['update','edit']]);
//        $this->middleware('permission:delete role', ['only' => ['destroy']]);
//    }

    public function index()
    {
        if( checkModulePermission('roles', 'view') ) {

            $roles = Role::get();
            return view('admin.role-permission.role.index', ['roles' => $roles]);
        }else {
            return redirect()->back()->with('error', __('lang.not permitted'));
        }
    }

    public function create()
    {
        if( checkModulePermission('roles', 'add') ) {

            return view('admin.role-permission.role.create');
        }else {
            return redirect()->back()->with('error', __('lang.not permitted'));
        }
    }


    public function store(Request $request)
    {
        if( checkModulePermission('roles', 'add') ) {

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

            return redirect(route('admin.roles.index'))->with('role_status', __('lang.Role Created Successfully'));
        }else {
            return redirect()->back()->with('error', __('lang.not permitted'));
        }
    }

    public function edit(Role $role)

    {
        if( checkModulePermission('roles', 'edit') ) {

            return view('admin.role-permission.role.edit', [
                'role' => $role
            ]);
        }else {
            return redirect()->back()->with('error', __('lang.not permitted'));
        }
    }

    public function update(Request $request, Role $role)
    {
        if( checkModulePermission('roles', 'edit') ) {

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

            return redirect(route('admin.roles.index'))->with('role_status', __('lang.Role Updated Successfully'));
        }else {
            return redirect()->back()->with('error', __('lang.not permitted'));
        }
    }

    public function destroy($roleId)
    {
        if( checkModulePermission('roles', 'delete') ) {

            $role = \App\Models\Role::with('modules')->find($roleId);
            $role->modules()->delete();
            $role->delete();
            return redirect(route('admin.roles.index'))->with('error', __('lang.Role Deleted Successfully'));
        }else {
            return redirect()->back()->with('error', __('lang.not permitted'));
        }
    }

    public function addPermissionToRole($roleId)
    {
        if( checkModulePermission('permissions', 'edit') ) {

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
        }else {
            return redirect()->back()->with('error', __('lang.not permitted'));
        }
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        if( checkModulePermission('permissions', 'edit') ) {

            $request->validate([
                'permission' => 'required'
            ]);

            $role = Role::findOrFail($roleId);
            $role->syncPermissions($request->permission);

            return redirect()->back()->with('status', 'Permissions added to role');
        }else {
            return redirect()->back()->with('error', __('lang.not permitted'));
        }
    }

    public function giveModuleToRoleShow($role_id)
    {
        if( checkModulePermission('permissions', 'view') ) {

            $role_name = Role::where('id', $role_id)->value('name');
            $role_modules = RoleModule::where('role_id', $role_id);
            $arr = [];

            return view('admin/role-permission/role/give_modules_to_role', compact('role_modules', 'role_id', 'role_name', 'arr'));
        }else {
            return redirect()->back()->with('error', __('lang.not permitted'));
        }
    }


    public function giveModuleToRoleStore(Request $request, $roleId)
    {

        if( checkModulePermission('permissions', 'edit') ) {

            //        DB::beginTransaction();
            try {
                //       dd( checkModule('teachers'));
//        dd(checkUserHasRoleHasModule());
                $role = \App\Models\Role::findOrFail($roleId);
                RoleModule::where('role_id', $roleId)->delete();
                $mods = [];
                if ($request->modules && $request->permission) {

                    foreach ($request->modules as $module) {
                        // $mods[] = RoleModule::create(['role_id' => $roleId, 'module_code' => $module, 'permissions' => 'view']);
                        if ($request->permission && isset($request->permission[$module])) {
                            $perms = implode(',', array_merge(['view'], $request->permission[$module]));
                            $mods[] = RoleModule::create(['role_id' => $roleId, 'module_code' => $module, 'permissions' => $perms]);
                        }
                    }

                    $role->modules()->saveMany($mods);
                }
//            DB::rollback();

                return redirect()->back()->with('success', __('lang.role and permission are updated successfully'));
            } catch (\Exception $e) {
//            DB::rollback();
//            // something went wrong
            }
        }else {
            return redirect()->back()->with('error', __('lang.not permitted'));
        }
    }
}
