<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::get();
        $models = BrandModel::latest()->paginate(20);
        return view('Backend.model', compact('models','brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'bid' => 'required',
            'mname'=>'required',
            'pic'=>'nullable|image'
        ]);
        $modelpic='branddummy.jpg';
        try
        {
            if($request->hasFile('pic'))
            {
                $modelpic='model-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/models/'),$modelpic);
            }
            $res= BrandModel::create(['bid'=> $request->bid ,'name'=>$request->mname,'image'=>'upload/models/'.$modelpic]);

            if($res)
            {
                session()->flash('success','Model Added Sucessfully');
            }
            else
            {
                session()->flash('error','Model not added ');
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
        $brands = Brand::get();
        $models = BrandModel::latest()->paginate(20);
        $id=Crypt::decrypt($id);
        $modeledit=BrandModel::find($id);
        if($modeledit)
        {
            return view('Backend.model',compact('models','modeledit','brands'));
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
            'bid' => 'required',
            'mname'=>'required',
            'pic'=>'nullable|image'
        ]);
        $modelpic='branddummy.jpg';
        try
        {
            if($request->hasFile('pic'))
            {
                $modelpic='model-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/models/'),$modelpic);
                $oldpic=Brand::find($id)->pluck('image')[0];
                    unlink(public_path($oldpic));
            }
            $res= BrandModel::create(['bid'=> $request->bid ,'name'=>$request->mname,'image'=>'upload/models/'.$modelpic]);

            if($res)
            {
                session()->flash('success','Model Updated Sucessfully');
            }
            else
            {
                session()->flash('error','Model not added ');
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
                $res=BrandModel::find($id)->delete();
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
