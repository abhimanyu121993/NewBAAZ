<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandModel;
use App\Models\Error;
use App\Models\FuelType;
use App\Models\ModelServiceMap;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceCharge;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
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
        $showservies = DB::table("services")
        ->select("services.id","services.name")->get();
        $modelmaps = ModelServiceMap::all();
        return view('Backend.modelservicemap', compact('modelmaps','models','fueltypes', 'services','showservies'));
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
        Log::info('store'.json_encode($request->all()));
        $request->validate([
            'model_id'=>'required',
            'service_id'=>'required',
            'fuel_id' => 'required',
            'price' => 'required',
            'discounted_price' => 'nullable',
            'percent'=>'nullable'
        ]);

        try
        {
        //     $DiscountedPrice=$request->dprice;
        //     dd($DiscountedPrice);
        //     $Price=$request->price;
        //     $DiscountedAmount=$Price-$DiscountedPrice;
        //     $DiscountedPercent=($DiscountedAmount / $Price)*100;
        //    dd($DiscountedPercent);


            $res= ModelServiceMap::create([
                'model_id'=>$request->model_id,
                'service_id' => $request->service_id,
                'fuel_id' => $request->fuel_id,
                'price' => $request->price,
                'discounted_price'=>$request->discounted_price,
                'percent'=>$request->percent,
                ]);

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
        $model_id = Crypt::decrypt($id);
        $fueltypes = FuelType::all();
        $services = Service::all();
        $modelmaps = ModelServiceMap::where('model_id', $model_id)->get();
        return view('Backend.modelservicemap', compact('modelmaps','fueltypes', 'services', 'model_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $model_id = Crypt::decrypt($id);
    //     $fueltypes = FuelType::all();
    //     $services = Service::all();
    //     $editmodelmap = ModelServiceMap::find($model_id);
    //     $modelmaps = ModelServiceMap::where('model_id', $editmodelmap->model_id)->get();
    //     if($editmodelmap)
    //     {
    //         return view('Backend.modelservicemap', compact('modelmaps','fueltypes', 'services', 'editmodelmap', 'model_id'));
    //     }
    //     else
    //     {
    //         session::flash('error','Something Went Wrong OR Data is Deleted');
    //         return redirect()->back();
    //     }
    // }
    public function Edit_model($id)
    {
        $model_id = Crypt::decrypt($id);
        $editmodelmap = ModelServiceMap::with('model')->find($model_id);
        return response()->json([
                    'status' => 200,
                'success' =>$editmodelmap
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function update(Request $request, $id)

    // {
    //     $request->validate([
    //         'service_id'=>'required',
    //         'fuel_id' => 'required',
    //         'price' => 'required',
    //         'discounted_price' => 'required',
    //         'percent'=>'required'
    //     ]);

    //     try
    //     {
    //     $res= ModelServiceMap::find($id)->update(['service_id' =>$request->service_id,'fuel_id' =>$request->fuel_id,'price' =>$request->price,'discounted_price'=>$request->discounted_price,'percent'=>$request->percent]);
    //      if($res)
    //         {
    //             session()->flash('success','Model Map Updated Sucessfully');
    //         }
    //         else
    //         {
    //             session()->flash('error','Model Map not Updated ');
    //         }
    //     }
    //     catch(Exception $ex)
    //     {
    //         $url=URL::current();
    //         Error::create(['url'=>$url,'message'=>$ex->getMessage()]);
    //         Session::flash('error','Server Error ');
    //     }
    //     return redirect()->back();
    // }

      public function Updatedit_model(Request $request, $id)
                        { $validator = Validator::make($request->all(), [
                             'price' => 'required',
                             'discounted_price' => 'required',
                             'percent'=>'required'
                        ]);
                        if ($validator->fails()) {
                            return response()->json([
                                'status' => 400,
                                'errors' => $validator->messages()
                            ]);
                        }
                        else
                        {
                         $model_id = Crypt::decrypt($id);
                        $model = ModelServiceMap::find($model_id);
                        $model->price = $request->input('price');
                        $model->discounted_price = $request->input('discounted_price');
                        $model->percent = $request->input('percent');

                         $model->update();

                        if ($model) {
                            return response()->json([
                                'status' => 200,
                                'message' => 'Update successfully'
                            ]);
                        }
                    }
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
                    session()->flash('success','Model Map deleted sucessfully');
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