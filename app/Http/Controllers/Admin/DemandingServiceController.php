<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemandingService;
use App\Models\Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class DemandingServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = DemandingService::get();
        return view('Backend.demanding_services', compact('services'));
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
            'bname'=>'required',
            'pic'=>'nullable|image'
        ]);
        try
        {
            if($request->hasFile('pic'))
            {
                $servicepic='dservice-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/demanding-services/'),$servicepic);
            }
            $res= DemandingService::create(['name'=>$request->bname,'pic'=>'upload/demanding-services/'.$servicepic]);

            if($res)
            {
                session()->flash('success','Service Added Sucessfully');
            }
            else
            {
                session()->flash('error','Service not added ');
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
        $services = DemandingService::get();
        $id=Crypt::decrypt($id);
        $editservice=DemandingService::find($id);
        if($editservice)
        {
            return view('Backend.demanding_services',compact('services','editservice'));
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
            'bname'=>'required',
            'pic'=>'nullable|image'
        ]);
        try
        {
            if($request->hasFile('pic'))
            {
                $servicepic='dservice-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/demanding-services/'),$servicepic);
                $oldpic=DemandingService::find($id)->pluck('pic')[0];
                    unlink(public_path($oldpic));
                    DemandingService::find($id)->update(['pic'=>$servicepic]);
            }
            $res= DemandingService::find($id)->update(['name'=>$request->bname,'pic'=>'upload/demanding-services/'.$servicepic]);

            if($res)
            {
                session()->flash('success','Service Updated Sucessfully');
            }
            else
            {
                session()->flash('error','Service not updated ');
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
        try
        {
                $res=DemandingService::find($id)->delete();
                if($res)
                {
                    session()->flash('success','Service deleted ducessfully');
                }
                else
                {
                    session()->flash('error','Service not deleted ');
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
