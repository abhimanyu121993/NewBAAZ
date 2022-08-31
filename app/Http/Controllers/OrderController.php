<?php

namespace App\Http\Controllers;

use App\Models\Error;
use App\Models\ModelServiceMap;
use App\Models\Order;
use App\Models\OrderDetail;
use Exception;
use Illuminate\Http\Request;
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
            'service_type' => 'required',
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
                $modelmap = ModelServiceMap::where('model_id',$req->model_id)->where('service_id', $req->service_type)->first();
                $oddtl = OrderDetail::create([
                    'order_id' => $order->id,
                    'model_id' => $req->model_id,
                    'service_type' =>$req->service_type,
                    'price' =>$modelmap->discounted_price ?? 0,
                ]);
                $ttamt += $modelmap->discounted_price ?? 0;
                $ordeup=Order::where('id',$oddtl->id)->update(['total_amount' => round($ttamt,2)]);
                Log::info('ordeup'.json_encode($ordeup));
            }
            if ($ordeup)
            {
                $order->order_details[0]->servicetype;
                $result = [
                    'data' => $order,
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
}
