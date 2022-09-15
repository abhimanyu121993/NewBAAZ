<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Error;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class CartController extends Controller
{
    public function showCart(Request $req)
    {
        $req->validate([
            'user_id' => 'required'
        ]);
        try {
            $cartItems = Cart::with('service')->where('user_id', $req->user_id)->get();
            if ($cartItems) {
                $result = [
                    'data' => $cartItems,
                    'message' => 'Cart detail found',
                    'status' => 200,
                    'error' => NULL
                ];
            } else {
                $result = [
                    'data' => NULL,
                    'message' => 'Empty Cart',
                    'status' => 200,
                    'error' => [
                        'message' => 'Server Error',
                        'code' => 305,
                    ]
                ];
            }
            return response()->json($result);
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
        }
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'model_id' => 'required',
            'service_id' => 'required'
        ]);
        try {
            $addTocart = Cart::create(['user_id' => $request->user_id, 'model_id' => $request->model_id, 'service_id' => $request->service_id, 'quantity' => 1]);
            if ($addTocart) {
                $result = [
                    'data' => $addTocart,
                    'message' => 'Service added to cart',
                    'status' => 200,
                    'error' => NULL
                ];
            } else {
                $result = [
                    'data' => NULL,
                    'message' => 'Service not added to cart',
                    'status' => 200,
                    'error' => [
                        'message' => 'Server Error',
                        'code' => 305,
                    ]
                ];
            }
            return response()->json($result);
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
        }
    }

    public function removeCartItems(Request $req)
    {
        $req->validate([
            'user_id' => 'required',
            'service_id' => 'required'
        ]);
        try {
            $res = Cart::where('user_id', $req->user_id)
                        ->where('service_id', $req->service_id)
                        ->delete();
            if ($res) {
                $result = [
                    'data' => NULL,
                    'message' => 'Cart deleted sucessfully',
                    'status' => 200,
                    'error' => NULL
                ];
            } else {
                $result = [
                    'data' => NULL,
                    'message' => 'Cart not deleted',
                    'status' => 200,
                    'error' => [
                        'message' => 'Server Error',
                        'code' => 305,
                    ]
                ];
            }
            return response()->json($result);
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
        }
    }

    // decrement brand and delete Quantity one by one


    public function removeCart($id)
    {
        try {
            $cart = Cart::find($id);
            $cartqnty = (int)$cart->quantity;
            if ($cartqnty > 1) {
                $res = $cart->update(['quantity' => $cart->quantity - 1]);
            } else {
                $res = $cart->delete();
            }
            if ($res) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
