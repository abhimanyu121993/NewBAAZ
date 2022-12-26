<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Error;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function userLogin(Request $req)
    {
        $req->validate([
            'mobileno' => 'required|min:10|max:10',
            'authentication' => 'required'
        ]);
        if ($req->authentication === 'TRUE')
        {
            $data = Customer::where('mobileno',$req->mobileno)->first();
            try
            {
                if ($data)
                {
                    $result = [
                        'data' => $data,
                        'message' => 'Login successfully',
                        'status' => 200,
                        'error' => NULL
                    ];
                }
                else
                {
                    $result = [
                        'data' => NULL,
                        'message' => 'User not found',
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
}
