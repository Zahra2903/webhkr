<?php

namespace App\Http\Controllers\Admins;

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
        $data = [
            'role' => Role::with('permissions')->get(),
            'permission' => Permission::all()
    ];
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
        ]);
        $role = Role::create([
            'name' => request('name'),
        ]);

        if ($role) {
            return response()->json([
                'success' => true,
                'message' => 'Role Created',
                'data'    => $role
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Tim Failed to Save',
        ], 409);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($role)
    {
        return Role::findorFail($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $role)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $data = Role::findOrFail($role);
        $data->update($request->all());

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Role Updated',
                'data'    => $data
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Role Failed to Update',
        ], 409);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findorfail($id);
        $role->delete();
        return response()->json([
            'message' => 'Role deleted successfully'
        ]);
    }
}
