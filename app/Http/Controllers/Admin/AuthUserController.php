<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuthUser;
use App\Models\Error;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;

class AuthUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $employees = User::get();
        return view('Backend.setup.employee', compact('employees', 'roles'));
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
        Log::info('request'.json_encode($request->all()));
        $request->validate([
            'name'=>'required',
            'phone'=>'nullable',
            'email'=>'required',
            'password'=>'nullable',
            'roleid' => 'required',
            'aadharid' => 'nullable',
            'pic'=>'image|nullable'
        ]);
        try
        {
            if($request->hasFile('pic'))
            {
                $emppic='emp-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/employees/'),$emppic);
            }
            $maxempid = User::max('id');
            $empid = 'BAAZ-'.sprintf('%5d', $maxempid+1);
            $hashpassword = Hash::make($request->password);
            $data = [
                'name' => $request->name,
                'empid' => $empid,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => $hashpassword,
                'aadharid' => $request->aadharid,
                'pic'=>'upload/employees/'.$emppic
            ];
            $role = Role::find($request->roleid);
            $res= User::create($data);
            if($res)
            {
                $res->assignRole($role->name);
                session()->flash('success','Employee Added Sucessfully');
            }
            else
            {
                session()->flash('error','Employee not added ');
            }
        }
        catch(Exception $ex)
        {
            $url=URL::current();
            Error::create(['url'=>$url,'message'=>$ex->getMessage()]);
            Session::flash('error','Server Error ');
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
        $roles = Role::all();
        $employees = User::get();
        $id=Crypt::decrypt($id);
        $editemployee=User::find($id);
        if($editemployee)
        {
            return view('Backend.setup.employee',compact('employees','editemployee','roles'));
        }
        else
        {
            session::flash('error','Something Went Wrong OR Data is Deleted');
            return redirect()->back();
        }
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
        Log::info('update'.json_encode($request->all()));
        $request->validate([
            'name'=>'required',
            'phone'=>'nullable',
            'email'=>'required',
            'roleid'=>'required',
            'aadharid' => 'nullable',
            'pic'=>'image'
        ]);
        try
        {
            if($request->hasFile('pic'))
            {
                $emppic='emp-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/employees/'),$emppic);
                $oldpic=User::find($id)->pluck('pic')[0];
                    unlink(public_path($oldpic));
                User::find($id)->update(['pic' => 'upload/employees/'.$emppic]);
            }
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'aadharid' => $request->aadharid
            ];
            $role = Role::find($request->roleid);
            $res= User::find($id)->update($data);

            if($res)
            {
                User::find($id)->syncRoles($role->name);
                session()->flash('success','Employee updated Sucessfully');
            }
            else
            {
                session()->flash('error','Employee not updated ');
            }
        }
        catch(Exception $ex)
        {
            $url=URL::current();
            Error::create(['url'=>$url,'message'=>$ex->getMessage()]);
            Session::flash('error','Server Error ');
        }
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id=Crypt::decrypt($id);
        try{
                $res=User::find($id)->delete();
                if($res)
                {
                    session()->flash('success','Employee deleted ducessfully');
                }
                else
                {
                    session()->flash('error','Employee not deleted ');
                }
            }
            catch(Exception $ex)
            {
                $url=URL::current();
                Error::create(['url'=>$url,'message'=>$ex->getMessage()]);
                Session::flash('error','Server Error ');
            }
            return redirect()->back();
    }
}
