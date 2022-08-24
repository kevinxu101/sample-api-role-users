<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::all()->toArray();
        return $role;
    }

    public function create(Request $request)
    {
        try {
            $role = new Role();
            $role->role_name = $request->role_name;
            $role->role_description = $request->role_description;
            $role->save();

            $success = true;
            $message = "Role Added successfully";

        } catch (\Exception $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);
    }

    public function edit(Request $request){
        $role = Role::where('id',$request->id)->first();
        return $role;
    }

    public function update(Request $request)
    {
        try {
            $role = Role::findOrFail($request->id);
            $role->role_name = $request->edit_role_name;
            $role->role_description = $request->edit_role_description;
            $role->save();

            $success = true;
            $message = "role updated successfully.";

        } catch (\Exception $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);

    }

    public function delete(Request $request){
        $role = Role::findOrFail($request->id)->delete();
        return $role;
    }
}
