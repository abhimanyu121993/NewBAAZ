<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Error;
use App\Models\Order;
use App\Models\OtherProduct;
use App\Models\Service;
use App\Models\ServiceCharge;
use App\Models\WorkshopOrder;
use App\Models\WorkshopOrderDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class WorkshopOrderController extends Controller
{
    public function orderServiceDetail($id)
    {
        $order = Order::find($id);
        // $services = Service::all();
        $serviceCharges = ServiceCharge::all();
        $otherProducts = OtherProduct::all();
        $serviceDetails = $order->workshop_order;
        $services = Service::getServiceDetail($order->order_details[0]->model_id);
        return view('Backend.order_service_detail', compact('services', 'serviceCharges', 'otherProducts','order', 'serviceDetails'));
    }

    public function addWorkshopOrder(Request $request)
    {
        Log::info('addworkshoporder'.json_encode($request->all()));
        $sprice = Service::getServiceDetailById($request->service_id, $request->model_id);
        $workshopOrder = WorkshopOrder::updateOrCreate(['order_id' => $request->order_id],[
            'order_no' => $request->order_no,
            'workshop_id' => $request->workshop_id,
            'total_amount' => (WorkshopOrder::where('order_id', $request->order_id)->first()->total_amount ?? 0) + ($sprice[0]->service_price ?? 0)
        ]);
        if($workshopOrder){
            $workshopOrderDetail = WorkshopOrderDetail::create([
                'workshop_order_id' => $workshopOrder->id,
                'type' => $request->service_type,
                'value' => $request->service_id,
                'amount' => $sprice[0]->service_price ?? 0
            ]);
            if($workshopOrderDetail)
            {
                session()->flash('success','Service added Sucessfully');
            }
            else
            {
                session()->flash('error','Service not added ');
            }
        }
        return redirect()->back();
    }

    public function addWorkshopLabour(Request $request)
    {
        // Log::info('addworkshoplabour'.json_encode($request->all()));
        // dd($request->all());
        $request->validate([
            'labour_id' => 'required',
            'labour_price' => 'required',
            'labour_quantity' => 'required'
        ]);

        $workshopOrder = WorkshopOrder::updateOrCreate(['order_id' => $request->order_id],[
            'order_no' => $request->order_no,
            'workshop_id' => $request->workshop_id,
            'total_amount' => (WorkshopOrder::where('order_id', $request->order_id)->first()->total_amount ?? 0) + (($request->labour_price * $request->labour_quantity) ?? 0)
        ]);
        if($workshopOrder){
            $workshopOrderDetail = WorkshopOrderDetail::create([
                'workshop_order_id' => $workshopOrder->id,
                'type' => $request->service_type,
                'value' => $request->labour_id,
                'quantity' => $request->labour_quantity,
                'amount' => (($request->labour_price * $request->labour_quantity) ?? 0)
            ]);
            if($workshopOrderDetail)
            {
                session()->flash('success','Labour Charge added Sucessfully');
            }
            else
            {
                session()->flash('error','Labour Charge not added ');
            }
        }
        return redirect()->back();
    }

    public function addWorkshopSpare(Request $request)
    {
        // Log::info('addworkshoporder'.json_encode($request->all()));
        $request->validate([
            'spare_id' => 'required',
            'spare_price' => 'required',
            'spare_quantity' => 'required'
        ]);

        $workshopOrder = WorkshopOrder::updateOrCreate(['order_id' => $request->order_id],[
            'order_no' => $request->order_no,
            'workshop_id' => $request->workshop_id,
            'total_amount' => (WorkshopOrder::where('order_id', $request->order_id)->first()->total_amount ?? 0) + (($request->spare_price * $request->spare_quantity) ?? 0)
        ]);
        if($workshopOrder){
            $workshopOrderDetail = WorkshopOrderDetail::create([
                'workshop_order_id' => $workshopOrder->id,
                'type' => $request->service_type,
                'value' => $request->spare_id,
                'quantity' => $request->spare_quantity,
                'amount' => (($request->spare_price * $request->spare_quantity) ?? 0)
            ]);
            if($workshopOrderDetail)
            {
                session()->flash('success','Spare charge added Sucessfully');
            }
            else
            {
                session()->flash('error','Spare charge not added ');
            }
        }
        return redirect()->back();
    }

    public function delService($id)
    {
        try{
                $id = Crypt::decrypt($id);
                $res=WorkshopOrderDetail::find($id);
                $workshopOrder = WorkshopOrder::where('id', $res->workshop_order_id)->first();
                $total_amount = $workshopOrder->total_amount - $res->amount;
                WorkshopOrder::where('id', $workshopOrder->id)->update(['total_amount' => $total_amount]);
                if($res->delete())
                {

                    session()->flash('success','Service deleted sucessfully');
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

    public function edpWork()
    {

        $orders = Order::orWhere('order_status',1)
        ->orWhere('order_status', NULL)
        ->get();
        //Log::info('pendingorders'.json_encode($pendingorders));
        return view('Backend.edp_work', compact('orders'));
    }

    public function invoice($id)
    {
        $order = Order::find($id);
        $serviceDetails = $order->workshop_order;
        return view('Backend.invoice', compact('serviceDetails', 'order'));
    }

    public function baazInvoice($id)
    {
        $order = Order::find($id);
        $serviceDetails = $order->workshop_order;
        return view('Backend.baaz_invoice', compact('serviceDetails', 'order'));
    }


}
