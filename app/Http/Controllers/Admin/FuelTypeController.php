<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Error;
use App\Models\FuelType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class FuelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fueltypes = FuelType::get();
        return view('Backend.fueltype', compact('fueltypes'));
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
        $fuelpic='branddummy.jpg';
        try
        {
            if($request->hasFile('pic'))
            {
                $fuelpic='fueltype-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/fueltype/'),$fuelpic);
            }
            $res= FuelType::create(['name'=>$request->name,'image'=>'upload/fueltype/'.$fuelpic]);

            if($res)
            {
                session()->flash('success','Brand Added Sucessfully');
            }
            else
            {
                session()->flash('error','Brand not added ');
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
        $fueltypes = FuelType::get();
        $id=Crypt::decrypt($id);
        $fueltypeedit=FuelType::find($id);
        if($fueltypeedit)
        {
            return view('Backend.fueltype',compact('fueltypeedit','fueltypes'));
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
        $brandpic='branddummy.jpg';
        try
        {
            if($request->hasFile('pic'))
            {
                $fuelpic='fueltype-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/fueltype/'),$fuelpic);
                $oldpic=FuelType::find($id)->pluck('image')[0];
                    unlink(public_path($oldpic));
                    FuelType::find($id)->update(['image'=>$fuelpic]);
            }
            $res= FuelType::find($id)->update(['name'=>$request->name,'image'=>'upload/fueltype/'.$fuelpic]);

            if($res)
            {
                session()->flash('success','Fuel Type Updated Sucessfully');
            }
            else
            {
                session()->flash('error','Fuel type not updated ');
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
                $res=FuelType::find($id)->delete();
                if($res)
                {
                    session()->flash('success','Brand deleted ducessfully');
                }
                else
                {
                    session()->flash('error','Brand not deleted ');
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
