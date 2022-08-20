<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Error;
use App\Models\HomeSlider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class HomeSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = HomeSlider::get();
        return view('Backend.homeslider', compact('sliders'));
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
            'link'=>'nullable',
            'pic'=>'image'
        ]);
        try
        {
            if($request->hasFile('pic'))
            {
                $sliderpic='hslider-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/homeslider/'),$sliderpic);
            }
            $res= HomeSlider::create(['link'=>$request->link,'image'=>'upload/homeslider/'.$sliderpic]);

            if($res)
            {
                session()->flash('success','Slider Added Sucessfully');
            }
            else
            {
                session()->flash('error','Slider not added ');
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
        $sliders = HomeSlider::get();
        $id=Crypt::decrypt($id);
        $slideredit=HomeSlider::find($id);
        if($slideredit)
        {
            return view('Backend.homeslider',compact('sliders','slideredit'));
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
            'link'=>'nullable',
            'pic'=>'image'
        ]);
        try
        {
            if($request->hasFile('pic'))
            {
                $sliderpic='hslider-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/homeslider/'),$sliderpic);
                $oldpic=HomeSlider::find($id)->pluck('image')[0];
                    unlink(public_path($oldpic));
                    HomeSlider::find($id)->update(['image'=>$sliderpic]);
            }
            $res= HomeSlider::find($id)->update(['link'=>$request->link,'image'=>'upload/homeslider/'.$sliderpic]);

            if($res)
            {
                session()->flash('success','Slider Updated Sucessfully');
            }
            else
            {
                session()->flash('error','Slider not updated ');
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
                $res=HomeSlider::find($id)->delete();
                if($res)
                {
                    session()->flash('success','Slider deleted ducessfully');
                }
                else
                {
                    session()->flash('error','Slider not deleted ');
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
