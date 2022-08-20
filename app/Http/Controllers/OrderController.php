<?php

namespace App\Http\Controllers;

use App\Models\Error;
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
            'slot' => 'required'
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
            $order = Order::create(['user_id' => $req->user_id, 'order_id' => $order_no, 'slot' => $req->slot]);
            $ttamt = 0;
            if ($order)
            {
                $service_type=json_decode($req->service_type);
                $price=json_decode( $req->price);
                for ($i = 0; $i < count($service_type); $i++)
                {
                    $oddtl = OrderDetail::create([
                        'order_id' => $order->id,
                        'service_type' =>$service_type[$i],
                        'price' =>$price[$i],
                    ]);
                    $ttamt += $price[$i];
                }
                $ordeup=Order::where('id',$oddtl->id)->update(['total_amount' => round($ttamt,2)]);
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
}
