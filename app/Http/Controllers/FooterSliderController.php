<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FooterSlider;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Exception;
class FooterSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footersliders = FooterSlider::get();
        return view('Backend.footerslider', compact('footersliders'));

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
            'title'=>'required',
            'pic'=>'image'
        ]);

        if($request->hasFile('pic'))
            {
                $sliderpic='hslider-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/footerslider/'),$sliderpic);
            }
            $res= FooterSlider::create(['title'=>$request->title,
            'image'=>'upload/footerslider/'.$sliderpic]);

            if($res)
            {
                session()->flash('success','Footer Slider Added Sucessfully');
            }
            else
            {
                session()->flash('error',' Footer Slider not added ');
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

        $footersliders = FooterSlider::get();
        $id=Crypt::decrypt($id);
        $footerslideredit=FooterSlider::find($id);
        if($footerslideredit)
        {
            return view('Backend.footerslider',compact('footersliders','footerslideredit'));
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
            'title'=>'required',
            'pic'=>'image'
        ]);

        {
            if($request->hasFile('pic'))
            {
                $sliderpic='hslider-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/footerslider/'),$sliderpic);
                $oldpic=FooterSlider::find($id)->pluck('image')[0];
                File::delete(public_path($oldpic));
                FooterSlider::find($id)->update(['image'=>'upload/footerslider/'.$sliderpic]);
            }
            $res= FooterSlider::find($id)->update(['title'=>$request->title]);

            if($res)
            {
                session()->flash('success','Footer Slider Updated Sucessfully');
            }
            else
            {
                session()->flash('error','Footer Slider not updated ');
            }
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
        $res=FooterSlider::find($id)->delete();
        if($res)
        {
            session()->flash('success','Footer Slider deleted sucessfully');
        }
        else
        {
            session()->flash('error','Footer Slider not deleted ');
        }
    }
    }