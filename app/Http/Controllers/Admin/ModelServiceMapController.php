<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandModel;
use App\Models\Error;
use App\Models\FuelType;
use App\Models\ModelServiceMap;
use App\Models\Service;
use App\Models\ServiceCharge;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ModelServiceMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fueltypes = FuelType::all();
        $services = Service::all();
        $models = BrandModel::all();
        $modelmaps = ModelServiceMap::all();
        return view('Backend.modelservicemap', compact('modelmaps','models','fueltypes', 'services'));
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
            'model_id'=>'required',
            'service_id'=>'required',
            'fuel_id' => 'required',
            'price' => 'required',
            'dprice' => 'required'
        ]);
        try
        {
            $res= ModelServiceMap::create(['model_id'=>$request->model_id,'service_id' => $request->service_id, 'fuel_id' => $request->fuel_id, 'price' => $request->price, 'discounted_price' => $request->dprice]);

            if($res)
            {
                session()->flash('success','Model Map Added Sucessfully');
            }
            else
            {
                session()->flash('error','Model Map not added ');
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
        $id = Crypt::decrypt($id);
        $fueltypes = FuelType::all();
        $services = Service::all();
        $models = BrandModel::all();
        $modelmaps = ModelServiceMap::all();
        $editmodelmap = ModelServiceMap::find($id);
        if($editmodelmap)
        {
            return view('Backend.modelservicemap', compact('modelmaps','models','fueltypes', 'services', 'editmodelmap'));
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
            'model_id'=>'required',
            'service_id'=>'required',
            'fuel_id' => 'required',
            'price' => 'required',
            'dprice' => 'required'
        ]);
        try
        {
            $res= ModelServiceMap::find($id)->update(['model_id'=>$request->model_id,'service_id' => $request->service_id, 'fuel_id' => $request->fuel_id, 'price' => $request->price, 'discounted_price' => $request->dprice]);

            if($res)
            {
                session()->flash('success','Model Map Updated Sucessfully');
            }
            else
            {
                session()->flash('error','Model Map not Updated ');
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
                $res=ModelServiceMap::find($id)->delete();
                if($res)
                {
                    session()->flash('success','Model Map deleted ducessfully');
                }
                else
                {
                    session()->flash('error','Model Map not deleted ');
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
