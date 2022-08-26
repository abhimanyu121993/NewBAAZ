<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BatteryType;
use App\Models\Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class BatteryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batterytypes = BatteryType::get();
        return view('Backend.batterytype', compact('batterytypes'));
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
        $request->validate([
            'name'=>'required',
            'pic'=>'nullable|image'
        ]);
        try
        {
            if($request->hasFile('pic'))
            {
                $batterypic='battery-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/batterytype/'),$batterypic);
            }
            $res= BatteryType::create(['name'=>$request->name,'image'=>'upload/batterytype/'.$batterypic]);

            if($res)
            {
                session()->flash('success','Battery Type Added Sucessfully');
            }
            else
            {
                session()->flash('error','Battery Type not added ');
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
        $batterytypes = BatteryType::get();
        $id=Crypt::decrypt($id);
        $batteryedit=BatteryType::find($id);
        if($batteryedit)
        {
            return view('Backend.batterytype',compact('batterytypes','batteryedit'));
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
        $request->validate([
            'name'=>'required',
            'pic'=>'nullable|image'
        ]);
        try
        {
            if($request->hasFile('pic'))
            {
                $batterypic='battery-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/batterytype/'),$batterypic);
                $oldpic=BatteryType::find($id)->pluck('image')[0];
                unlink(public_path($oldpic));
                BatteryType::find($id)->update(['image'=>$batterypic]);
            }
            $res= BatteryType::find($id)->update(['name'=>$request->name]);

            if($res)
            {
                session()->flash('success','Battery Type Updated Sucessfully');
            }
            else
            {
                session()->flash('error','Battery Type not updated ');
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
                $res=BatteryType::find($id)->delete();
                if($res)
                {
                    session()->flash('success','Battery Type deleted ducessfully');
                }
                else
                {
                    session()->flash('error','Battery Type not deleted ');
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
