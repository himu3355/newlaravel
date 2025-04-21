<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndParmissionController extends Controller
{
    public function index() {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('backend.randp.index', compact(['roles', 'permissions']));
    }

    public function update(Request $request)
    {
        unset($request['_token']);

        $roles = Role::all();
        $permissions = Permission::all();
        foreach ($roles as $role) {
            foreach ($permissions as $permission) {
                $role->revokePermissionTo($permission->name);
            }
        }

        foreach ($request->toArray() as $reqRole => $reqPermissions) {
            $role = Role::findByName($reqRole);
            $role->givePermissionTo($reqPermissions);
        }

        return redirect('/rolesandpermission');
    }

    public function addNewRole(Request $request) {

        $validator = Validator::make($request->all(), [
            'roleName' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/rolesandpermission')
                ->withErrors($validator)
                ->with('errorMessage',"something went wrong!")
                ->withInput();
        }
        if(Role::where('name',$request->roleName)->count() != 0){
            return redirect('/rolesandpermission')->with('errorMessage','Duplicat Role.');
        }
        Role::create(['name' => $request->roleName]);
        return redirect('/rolesandpermission');
    }


    public function addNewPermission(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'permissionName' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/rolesandpermission')
                ->withErrors($validator)
                ->with('errorMessage',"Something went wrong!")
                ->withInput();
        }
        if(Permission::where('name',$request->permissionName)->count() != 0){
            return redirect('/rolesandpermission')->with('errorMessage','Duplicat Permission.');
        }
        Permission::create(['name' => $request->permissionName]);
        return redirect('/rolesandpermission');
    }

    public function deleteRole(Role $role) {
        if ($role->name == 'admin') {
            return redirect('/rolesandpermission')
                ->with('errorMessage',"You can not delete default role.")
                ->withInput();
        }
        $res = $role->destroy($role);
        return redirect('/rolesandpermission');
    }

    public function deletePermission($permission) {
        $res = Permission::destroy($permission);
        return $res;
        // return redirect('/rolesandpermission');
    }
}
