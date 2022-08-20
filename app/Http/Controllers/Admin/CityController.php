<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Error;
use App\Models\Zone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::all();
        $areas = Area::all();
        $cities = City::all();
        return view('Backend.setup.city', compact('cities', 'zones', 'areas'));
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
            'zone_id' => 'required',
            'area_id' => 'required'
        ]);
        try
        {
            $res= City::create(['name'=>$request->name,'zone_id' => $request->zone_id, 'area_id' => $request->area_id]);

            if($res)
            {
                session()->flash('success','City Added Sucessfully');
            }
            else
            {
                session()->flash('error','City not added ');
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
        $zones = Zone::all();
        $areas = Area::all();
        $cities = City::get();
        $id=Crypt::decrypt($id);
        $editcity=City::find($id);
        if($editcity)
        {
            return view('Backend.setup.city',compact('cities','editcity', 'zones', 'areas'));
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
            'zone_id' => 'required',
            'area_id' => 'required'
        ]);
        try
        {
            $res= City::find($id)->update(['name'=>$request->name, 'zone_id' => $request->zone_id, 'area_id' => $request->area_id]);

            if($res)
            {
                session()->flash('success','City Updated Sucessfully');
            }
            else
            {
                session()->flash('error','City not updated ');
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
                $res=City::find($id)->delete();
                if($res)
                {
                    session()->flash('success','City deleted ducessfully');
                }
                else
                {
                    session()->flash('error','City not deleted ');
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
