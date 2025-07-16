<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return response()->json([
            'roles'=>$roles]);
    }
}
