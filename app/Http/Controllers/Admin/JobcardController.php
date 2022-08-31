<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BatteryType;
use App\Models\Error;
use App\Models\Jobcard;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class JobcardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        Log::info('orderjobcard'.json_encode($request->all()));
        // $request->validate([
        //     'name'=>'required',
        //     'country_id' => 'required',
        //     'zone_id' => 'required',
        //     'area_id' => 'required'
        // ]);
        try
        {
            $data = [
                'order_id' => $request->order_id,
                'regno' => $request->regno,
                'odometer_reading' => $request->odometer_reading,
                'manufacturing_year' => $request->manufacturing_year,
                'gender' => $request->gender,
                'mechanic_name' => $request->mechanic_name,
                'arrival_mode' => $request->arrival_mode,
                'walkin_date' => $request->walkin_date,
                'walkin_time' => $request->walkin_time,
                'cust_name' => $request->cust_name,
                'cust_phone' => $request->cust_phone,
                'cust_email' => $request->cust_email,
                'cust_address' => $request->cust_address,
                'fuel_level' => $request->fuel_level,
                'floor_mat' => $request->floor_mat,
                'wheel_cap' => $request->wheel_cap,
                'head_rest' => $request->head_rest,
                'mud_flap' => $request->mud_flap,
                'battery_id' => $request->battery_id,
                'interior_inventory' => $request->interior_inventory,
                'document' => $request->document,
                'status' => 1
            ];
            $res= Jobcard::create($data);

            if($res)
            {
                session()->flash('success','Jobcard Added Sucessfully');
            }
            else
            {
                session()->flash('error','Jobcard not added ');
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
        Log::info('orderjobcard'.$id);
        $batterytypes = BatteryType::all();
        $oid = $id;
        $jobcard = Jobcard::where('order_id',$id)->first();
        return view('Backend.jobcard', compact('batterytypes', 'oid', 'jobcard'));
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
        Log::info('orderjobcard'.json_encode($request->all()));
        // $request->validate([
        //     'name'=>'required',
        //     'country_id' => 'required',
        //     'zone_id' => 'required',
        //     'area_id' => 'required'
        // ]);
        try
        {
            $data = [
                'order_id' => $request->order_id,
                'regno' => $request->regno,
                'odometer_reading' => $request->odometer_reading,
                'manufacturing_year' => $request->manufacturing_year,
                'gender' => $request->gender,
                'mechanic_name' => $request->mechanic_name,
                'arrival_mode' => $request->arrival_mode,
                'walkin_date' => $request->walkin_date,
                'walkin_time' => $request->walkin_time,
                'cust_name' => $request->cust_name,
                'cust_phone' => $request->cust_phone,
                'cust_email' => $request->cust_email,
                'cust_address' => $request->cust_address,
                'fuel_level' => $request->fuel_level,
                'floor_mat' => $request->floor_mat,
                'wheel_cap' => $request->wheel_cap,
                'head_rest' => $request->head_rest,
                'mud_flap' => $request->mud_flap,
                'battery_id' => $request->battery_id,
                'interior_inventory' => $request->interior_inventory,
                'document' => $request->document,
                'status' => 1
            ];
            $res= Jobcard::find($id)->update($data);

            if($res)
            {
                session()->flash('success','Jobcard Added Sucessfully');
            }
            else
            {
                session()->flash('error','Jobcard not added ');
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
        //
    }
}
