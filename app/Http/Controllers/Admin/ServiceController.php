<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Error;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::get();
        $services = Service::latest()->paginate(20);
        return view('Backend.service', compact('category','services'));
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
            'cid' => 'required',
            'sname'=>'required',
            'sprice'=>'required',
            'desc' => 'nullable',
            'pic'=>'nullable|image'
        ]);
        $servicepic='branddummy.jpg';
        try
        {
            if($request->hasFile('pic'))
            {
                $servicepic='model-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/service/'),$servicepic);
            }
            $res= Service::create(['cid'=> $request->cid ,'name'=>$request->sname,'price'=>$request->sprice,'desc'=>$request->desc,'image'=>'upload/service/'.$servicepic]);

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
        $category = Category::get();
        $services = Service::latest()->paginate(20);
        $id=Crypt::decrypt($id);
        $serviceedit=Service::find($id);
        if($serviceedit)
        {
            return view('Backend.service',compact('category','serviceedit','services'));
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
            'cid' => 'required',
            'sname'=>'required',
            'sprice'=>'required',
            'desc' => 'nullable',
            'pic'=>'nullable|image'
        ]);
        $servicepic='branddummy.jpg';
        try
        {
            if($request->hasFile('pic'))
            {
                $servicepic='model-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/service/'),$servicepic);
                $oldpic=Service::find($id)->pluck('image')[0];
                    unlink(public_path($oldpic));
            }
            $res= Service::create(['cid'=> $request->cid ,'name'=>$request->sname,'price'=>$request->sprice,'desc'=>$request->desc,'image'=>'upload/service/'.$servicepic]);

            if($res)
            {
                session()->flash('success','Service Updated Sucessfully');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id=Crypt::decrypt($id);
        try{
                $res=Service::find($id)->delete();
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
