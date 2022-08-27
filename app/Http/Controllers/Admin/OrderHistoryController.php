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
        Log::info('role'.json_encode($userrole));
        Log::info('user id'.json_encode($userid));
        $workshops = User::role('Workshop')->get();
        if($userrole == 'Superadmin') {
            $pendingorders = Order::orWhere('order_status',1)
            ->orWhere('order_status', NULL)
            ->paginate(20);
        //Log::info('pendingorders'.json_encode($pendingorders));
        return view('Backend.pending_orders', compact('pendingorders', 'workshops'));
        }
        elseif($userrole == 'Workshop') {
            $pendingorders = Order::Where('assigned_workshop', $userid)
                ->Where('order_status',1)
                ->paginate(20);
        //Log::info('pendingorders'.json_encode($pendingorders));
        return view('Backend.pending_orders', compact('pendingorders'));
        }
    }

    public function confirmedOrders()
    {
        $userrole = Auth::user()->roles[0]->name;
        $userid = Auth::user()->id;
        $workshops = User::role('Workshop')->get();
        if($userrole == 'Superadmin') {
            $confirmedorders = Order::Where('order_status',2)
            ->paginate(20);
        //Log::info('pendingorders'.json_encode($pendingorders));
        return view('Backend.confirmed_orders', compact('confirmedorders', 'workshops'));
        }
        elseif($userrole == 'Workshop') {
            $confirmedorders = Order::Where('assigned_workshop', $userid)
                ->Where('order_status',2)
                ->paginate(20);
        //Log::info('pendingorders'.json_encode($pendingorders));
        return view('Backend.confirmed_orders', compact('confirmedorders'));
        }
    }

    public function jobcard($id)
    {
        Log::info('orderjobcard'.$id);
        $batterytypes = BatteryType::all();
        $oid = $id;
        //$jobcard = Jobcard::find($id);
        return view('Backend.jobcard', compact('batterytypes', 'oid'));
    }

    public function orderJobcard(Request $request)
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

    public function orderServiceDetail()
    {
        $services = Service::all();
        $serviceCharges = ServiceCharge::all();
        $otherProducts = OtherProduct::all();
        return view('Backend.order_service_detail', compact('services', 'serviceCharges', 'otherProducts'));
    }
}
