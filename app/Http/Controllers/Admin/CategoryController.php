<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::get();
        return view('Backend.category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
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
            'cname'=>'required',
            'pic'=>'nullable|image'
        ]);
        $catpic='branddummy.jpg';
        try
        {
            if($request->hasFile('pic'))
            {
                $catpic='category-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/category/'),$catpic);
            }
            $res= Category::create(['name'=>$request->cname,'image'=>'upload/category/'.$catpic]);

            if($res)
            {
                session()->flash('success','Category Added Sucessfully');
            }
            else
            {
                session()->flash('error','Category not added ');
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
    public function show()
    {
       
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
        $id=Crypt::decrypt($id);
        $categoryedit=Category::find($id);
        if($categoryedit)
        {
            return view('Backend.category',compact('category','categoryedit'));
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
            'cname'=>'required',
            'pic'=>'nullable|image'
        ]);
        $brandpic='branddummy.jpg';
        try
        {
            if($request->hasFile('pic'))
            {
                $catpic='category-'.time().'-'.rand(0,99).'.'.$request->pic->extension();
                $request->pic->move(public_path('upload/category/'),$catpic);
                $oldpic=Category::find($id)->pluck('image')[0];
                    unlink(public_path($oldpic));
                    Category::find($id)->update(['image'=>$catpic]);
            }
            $res= Category::find($id)->update(['name'=>$request->cname,'image'=>'upload/category/'.$catpic]);

            if($res)
            {
                session()->flash('success','Category Updated Sucessfully');
            }
            else
            {
                session()->flash('error','Category not updated ');
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
                $res=Category::find($id)->delete();
                if($res)
                {
                    session()->flash('success','Category deleted ducessfully');
                }
                else
                {
                    session()->flash('error','Category not deleted ');
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
