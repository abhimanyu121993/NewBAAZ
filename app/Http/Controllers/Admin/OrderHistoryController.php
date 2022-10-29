<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BatteryType;
use App\Models\Error;
use App\Models\Jobcard;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OtherProduct;
use App\Models\Service;
use App\Models\ServiceCharge;
use App\Models\User;
use App\Models\Workshop;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class OrderHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->paginate(20);
        return view('Backend.orderhistory', compact('orders'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $id=Crypt::decrypt($id);
            $order = Order::find($id);
            $orderDetails = Order::where('id', $id)->first();
            return view('Backend.userorderdetail', compact('orderDetails', 'order'));
        }
        catch (Exception $ex)
        {
            $url=URL::current();
            Error::create(['url'=>$url,'message'=>$ex->getMessage()]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function pendingOrders()
    {
        $userrole = Auth::user()->roles[0]->name;
        $userid = Auth::user()->id;
        $workshops = User::role('Workshop')->get();
        if($userrole == 'Superadmin') {
            $pendingorders = Order::orWhere('order_status',1)
            ->orWhere('order_status', NULL)
            ->paginate(20);
        return view('Backend.pending_orders', compact('pendingorders', 'workshops'));
        }
        elseif($userrole == 'Workshop') {
            $pendingorders = Order::Where('assigned_workshop', $userid)
                ->Where('order_status',1)
                ->paginate(20);
        Log::info('pendingorders'.json_encode($pendingorders));
        return view('Backend.pending_orders', compact('pendingorders', 'workshops'));
        }
        else {
            $pendingorders = Order::orWhere('order_status',1)
            ->orWhere('order_status', NULL)
            ->paginate(20);
        //Log::info('pendingorders'.json_encode($pendingorders));
        return view('Backend.pending_orders', compact('pendingorders', 'workshops'));
        }
    }

    // public function confirmedOrders()
    // {
    //     $userrole = Auth::user()->roles[0]->name;
    //     $userid = Auth::user()->id;
    //     $workshops = User::role('Workshop')->get();
    //     if($userrole == 'Superadmin') {
    //         $confirmedorders = Order::Where('order_status',2)
    //         ->paginate(20);
    //     //Log::info('pendingorders'.json_encode($pendingorders));
    //     return view('Backend.confirmed_orders', compact('confirmedorders', 'workshops'));
    //     }
    //     elseif($userrole == 'Workshop') {
    //         $confirmedorders = Order::Where('assigned_workshop', $userid)
    //             ->Where('order_status',1)
    //             ->paginate(20);
    //     Log::info('confirmedorders'.json_encode($confirmedorders));
    //     return view('Backend.confirmed_orders', compact('confirmedorders'));
    //     }
    // }

}
