<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermissionName;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = PermissionName::all();
        return view('Backend.permission', compact('permissions'));
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
        try
        {
            PermissionName::create(['name'=>$request->name]);
            Permission::create(['name'=>$request->name]);
            Permission::create(['name'=>$request->name.'_create']);
            Permission::create(['name'=>$request->name.'_edit']);
            Permission::create(['name'=>$request->name.'_delete']);
            Permission::create(['name'=>$request->name.'_read']);
            Session()->flash('success','Permission Added Successfully');
        }
        catch(Exception $ex)
        {
            Session()->flash('fail','Permission Not Added ');
        }
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
        $id = Crypt::decrypt($id);
        $editrole = Role::find($id);
        $roles = Role::all();
        $permissions = PermissionName::all();
        $editpermission = $editrole->permissions;
        return view('Backend.user_permission', compact('roles', 'permissions', 'editpermission', 'editrole'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function userPermission()
    {
        $roles = Role::all();
        $permissions = PermissionName::all();
        return view('Backend.user_permission', compact('roles', 'permissions'));
    }

    public function assignPermission(Request $request)
    {
        Log::info('assignPermission'.json_encode($request->all()));
        $role=Role::where('id',$request->roleid)->first();
        if($role->syncPermissions($request->permissionckbx))
        {
            Session()->flash('success','Permission Granted Successfully');
        }
        else
        {
            Session()->flash('fail','Permission not granted ');
        }
        return redirect()->back();
    }

    public function roleHasPermission()
    {
        $role = Role::all();
        $permissions = Permission::all();
        return view('Backend.role_has_permission', compact('role', 'permissions'));
    }
}
