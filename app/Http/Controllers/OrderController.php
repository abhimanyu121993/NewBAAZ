<?php

namespace App\Http\Controllers;

use App\Models\Error;
use App\Models\ModelServiceMap;
use App\Models\Order;
use App\Models\OrderDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class OrderController extends Controller
{
    public function orderPlaced(Request $req)
    {
        $req->validate([
            'user_id' => 'required',
            'slot' => 'required',
            'model_id' => 'required',
            'service_id' => 'required',
            'payment_mode' => 'required'
        ]);
        try
        {
            $n = Order::max('order_id');
            if($n)
            {
                $order_no=$n+1;
            }
            else
            {
                $order_no=1;
            }
            $order_no=sprintf('%05d',$order_no);
            $order = Order::create(['user_id' => $req->user_id, 'order_id' => $order_no, 'slot' => $req->slot, 'order_status' => 1, 'payment_mode' => $req->payment_mode]);
            $ttamt = 0;
            if ($order)
            {
                foreach($req->service_id as $sid){
                    $modelmap = ModelServiceMap::where('model_id',$req->model_id)->where('service_id', $sid)->first();
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'model_id' => $req->model_id,
                        'service_type' =>$sid,
                        'price' =>round($modelmap->discounted_price ?? 0, 2),
                    ]);
                    $ttamt += $modelmap->discounted_price ?? 0;
                    $ordeup=Order::where('id',$order->id)->update(['total_amount' => round($ttamt,2)]);
                }
            }
            if ($ordeup)
            {
                Log::info('orders 2'.json_encode($order));
                Log::info('order details'.json_encode($order->order_details));
                $result = [
                    'data' => $order->order_details,
                    'message' => 'Order placed succesfully',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'Order not placed',
                    'status' => 200,
                    'error' => [
                        'message' => 'Server Error',
                        'code' => 305,
                    ]
                ];
            }
        }
        catch (Exception $ex)
        {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            Session::flash('error', 'Server Error ');
        }
        return response()->json($result);
    }

    public function orderHistory()
    {
        try
        {
            $orders = Order::get();
            if ($orders)
            {
                $result = [
                    'data' => $orders,
                    'message' => 'Order history details',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'Order history not found',
                    'status' => 200,
                    'error' => [
                        'message' => 'Server Error',
                        'code' => 305,
                    ]
                ];
            }
            return response()->json($result);
        }
        catch (Exception $ex)
        {
            $url=URL::current();
            Error::create(['url'=>$url,'message'=>$ex->getMessage()]);
        }
    }

    public function singleUserOrderHistory(Request $req)
    {
        $req->validate([
            'user_id' => 'required'
        ]);
        try
        {
            $orders = Order::with('order_details')->where('user_id',$req->user_id)->get();
            if ($orders)
            {
                $result = [
                    'data' => $orders,
                    'message' => 'Order history found',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'Order history not found',
                    'status' => 200,
                    'error' => [
                        'message' => 'Server Error',
                        'code' => 305,
                    ]
                ];
            }
            return response()->json($result);
        }
        catch (Exception $ex)
        {
            $url=URL::current();
            Error::create(['url'=>$url,'message'=>$ex->getMessage()]);
        }
    }

    public function userInvoiceLink(Request $req)
    {
        $req->validate([
            'order_id' => 'required'
        ]);
        try
        {
            $orders = Order::where('user_id',$req->user_id)->get();
            $serviceDetails = $orders->workshop_order;
            $pdf = Pdf::loadView('Backend.invoice', ['serviceDetails' => $serviceDetails, 'order' => $orders]);
            //$pdf = PDF::loadView('Backend.invoice',['serviceDetails' => $serviceDetails, 'order' => $orders]);
            if ($pdf)
            {
                $result = [
                    'data' => $pdf->download('invoice.pdf'),
                    'message' => 'User Invoice found',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'user not found',
                    'status' => 200,
                    'error' => [
                        'message' => 'Server Error',
                        'code' => 305,
                    ]
                ];
            }
            return $result;
        }
        catch (Exception $ex)
        {
            $url=URL::current();
            Error::create(['url'=>$url,'message'=>$ex->getMessage()]);
        }
    }

    public function razorCallBack(Request $request)
    {
        $request->validate([
            'amount' => 'required'
        ]);
        try
        {
            $n = Order::max('order_id');
            if($n)
            {
                $invoice_no=$n+1;
            }
            else
            {
                $invoice_no=1;
            }
            $invoice_no='BAAZ/INV/'.sprintf('%05d',$invoice_no);
            $orders = Order::with('order_details')->where('user_id',$request->user_id)->get();
            if ($orders)
            {
                $result = [
                    'data' => $orders,
                    'message' => 'Order history found',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'Order history not found',
                    'status' => 200,
                    'error' => [
                        'message' => 'Server Error',
                        'code' => 305,
                    ]
                ];
            }
            return response()->json($result);
        }
        catch (Exception $ex)
        {
            $url=URL::current();
            Error::create(['url'=>$url,'message'=>$ex->getMessage()]);
        }
    }
    public function create_order(Request $request)
    {
        $request->validate([
            'total_amount' => 'required',
            'order_id' => 'required'
        ]);
        $res=Http::withBasicAuth(env('RAZOR_KEY'),env('RAZOR_SECRET')
        )->post('https://api.razorpay.com/v1/orders',[
            "amount"=>$request->total_amount * 100,
            "currency"=>"INR",
            "receipt"=> $request->order_id,
            "notes"=> [
              "notes_key_1"=> "BAAZ SERVICE"]
        ]);
        return $res->object();
    }

}
