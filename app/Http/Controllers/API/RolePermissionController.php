<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Response;


class RolePermissionController extends Controller
{
    //assign a role to a user
     public function assignRole(Request $request, $userId)
    {
        $request->validate([
            'roles' => 'required|array',
            'role. *' => 'required|string|exists:roles,name',
        ]);

        $user = User::findOrFail($userId);


        $user->assignRole($request->roles);

        return response()->json(['message' => 'Role assigned successfully']);
    }

    //asign a a permission to a  user 

     public function givePermission(Request $request, $userId)
    {
        $request->validate([
            'permission' => 'required|string|exists:permissions,name',
        ]);

        $user = User::findOrFail($userId);
        $user->givePermissionTo($request->permission);

        return response()->json(['message' => 'Permission granted successfully']);
    }

    // Revoke a permission from a user
    public function revokePermission(Request $request, $userId)
    {
        $request->validate([
            'permission' => 'required|string|exists:permissions,name',
        ]);

        $user = User::findOrFail($userId);
        $user->revokePermissionTo($request->permission);

        return response()->json(['message' => 'Permission revoked successfully']);
    }

    // Remove a role from a user
    public function removeRole(Request $request, $userId)
    {
        $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::findOrFail($userId);
        $user->removeRole($request->role);

        return response()->json(['message' => 'Role removed successfully']);
    }
    

    public function getUserRoles($userId)
    {
        $user = User::findOrFail($userId);
        $roles = $user->getRoleNames(); // returns a collection of role names
        return response()->json($roles);
    }

    public function getUserPermissions($userId)
    {
        $user = User::findOrFail($userId);
        $permissions = $user->getPermissionNames(); // returns a collection of permission names
        return response()->json($permissions);
    }

    public function getAllRoles()
    {
        $roles = Role::all(); // get all roles
        return response()->json($roles);
    }

    public function getAllPermissions()
    {
        $permissions = Permission::all(); // get all permissions
        return response()->json($permissions);
    }


}
  

