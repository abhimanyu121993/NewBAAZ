<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Error;
use App\Models\Workshop;
use App\Models\Zone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        $zones = Zone::all();
        $cities = City::all();
        $workshops = Workshop::all();
        return view('Backend.workshop',compact('workshops'));
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
            if($request->hasFile('pic'))
            {
                $wsppic='wosp-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/workshops/'),$wsppic);
            }
            if($request->hasFile('gstpic'))
            {
                $gstpic='GST-'.$request->name.time().'-'.rand(0,99).'.'.$request->gstpic->extension();
                $request->gstpic->move(public_path('upload/workshops/gst'),$gstpic);
            }

            $hashpassword = Hash::make($request->password);
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => $hashpassword,
                'owner_name' => $request->owner_name,
                'gst' => $request->gst,
                'pic'=>'upload/workshops/'.$wsppic,
                'gstpic'=>'upload/workshops/gst/'.$gstpic
            ];
            $res= Workshop::create($data);

            if($res)
            {
                session()->flash('success','Workshop created Sucessfully');
            }
            else
            {
                session()->flash('error','Workshop not created ');
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
        $countries = Country::all();
        $zones = Zone::all();
        $cities = City::all();
        $workshops = Workshop::get();
        $id=Crypt::decrypt($id);
        $editworkshop=Workshop::find($id);
        if($editworkshop)
        {
            return view('Backend.workshop',compact('workshops','editworkshop'));
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
        try
        {
            if($request->hasFile('pic'))
            {
                $wsppic='wosp-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/workshops/'),$wsppic);
                $oldpic=Workshop::find($id)->pluck('pic')[0];
                    unlink(public_path($oldpic));
                Workshop::find($id)->update(['pic' => 'upload/workshops/'.$wsppic]);
            }
            if($request->hasFile('gstpic'))
            {
                $gstpic='GST-'.$request->name.time().'-'.rand(0,99).'.'.$request->gstpic->extension();
                $request->gstpic->move(public_path('upload/workshops/gst/'),$gstpic);
                $oldpic=Workshop::find($id)->pluck('gstpic')[0];
                    unlink(public_path($oldpic));
                Workshop::find($id)->update(['gstpic' => 'upload/workshops/gst/'.$wsppic]);
            }

            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'owner_name' => $request->owner_name,
                'gst' => $request->gst
            ];
            $res= Workshop::find($id)->update($data);

            if($res)
            {
                session()->flash('success','Workshop updated Sucessfully');
            }
            else
            {
                session()->flash('error','Workshop not updated ');
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
                $res=Workshop::find($id)->delete();
                if($res)
                {
                    session()->flash('success','Workshop deleted ducessfully');
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
