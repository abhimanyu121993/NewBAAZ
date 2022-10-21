<?php

namespace App\Http\Controllers;

use App\Models\BrandModel;
use App\Models\Customer;
use App\Models\Error;
use App\Models\TestUser;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserVehicleMap;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    public function showProfile(Request $req)
    {
        $req->validate([
            'user_id' => 'required'
        ]);
        try
        {
            $user = Customer::find($req->user_id);
            if ($user)
            {
                $result = [
                    'data' => $user,
                    'message' => 'User Found',
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

    public function updateProfile(Request $req)
    {
        $req->validate([
            'mobileno' => 'required|min:10|max:10',
            'fcm_token'=>'required',
        ]);
        try
        {
            $user = Customer::where('mobileno',$req->mobileno)->first();
            if($user == null || $user == NULL)
            {
                $userup = Customer::create([
                    'mobileno' => $req->mobileno,
                    'fcm_token'=>$req->fcm_token
                ]);
            }
            if ($user)
            {
                $result = [
                    'data' => $user,
                    'message' => 'User data fetched successfully',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => $userup,
                    'message' => 'User created successfully',
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

    public function editProfile(Request $req)
    {
        $req->validate([
            'user_id' => 'required',
        ]);
        try
        {
            $user = Customer::where('id',$req->user_id)->first();
            if ($user)
            {
                $result = [
                    'data' => $user,
                    'message' => 'User data fetched successfully',
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

    public function editUpdateProfile(Request $req)
    {
        $req->validate([
            'user_id' => 'required',
            'name' => 'required',
            'gender' => 'nullable',
            'dob' => 'nullable',
            'email' => 'nullable'
        ]);
        try
        {
            $user = Customer::find($req->user_id)->update(['name' => $req->name, 'gender' => $req->gender, 'dob' => $req->dob, 'email' => $req->email]);
            if ($user)
            {
                $result = [
                    'data' => $user,
                    'message' => 'User data updated successfully',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'User not updated',
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

    public function userVehicleMap(Request $req)
    {
        $req->validate([
            'user_id' => 'required',
            'model_id' => 'required',
            'fuel_type_id' => 'required'
        ]);

        try
        {
            $model = BrandModel::find($req->model_id);
            $batchno = $req->user_id.'-'.time().'-'.rand(1,99);
            $data = [
                'userid' => $req->user_id,
                'modelid' => $req->model_id,
                'fueltype' => $req->fuel_type_id,
                'batchno' => $batchno,
                'brand_name' => $model->brand->name,
                'model_name' => $model->name,
                'model_image' => $model->image
            ];
            $uservehiclemap = UserVehicleMap::create($data) ;
            if ($uservehiclemap)
            {
                $result = [
                    'data' => $uservehiclemap,
                    'message' => 'Vehicle added successfully',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'Vehicle not added successfully',
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

    public function userVehicles(Request $req)
    {
        $req->validate([
            'user_id' => 'required'
        ]);
        try
        {
            $uservehicle = Customer::with('userHasVehicles')->find($req->user_id);
           // $uservehicle->userHasVehicles;
            if ($uservehicle)
            {
                $result = [
                    'data' => $uservehicle,
                    'message' => 'User vehicles details found',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'User vehicles not found',
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

    public function fetchUserAddress(Request $req)
    {
        $req->validate([
            'user_id' => 'required'
        ]);
        try
        {
            $user = Customer::with('userad')->find($req->user_id);
            $user->userad;
            return $user;
            if ($user)
            {
                $result = [
                    'data' => $user,
                    'message' => 'User address found',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'User address not found',
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

    public function updateUserAddress(Request $req)
    {
        $req->validate([
            'user_id' => 'required',
            'address' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'pincode' => 'nullable',
            'status' => 'nullable'
        ]);
        try
        {
            $data = [
                'address' => $req->address,
                'city' => $req->city,
                'state' => $req->state,
                'country' => $req->country,
                'pincode' => $req->pincode,
                'status' => $req->status
            ];
            $user = Customer::find($req->user_id)->update($data);
            if ($user)
            {
                $result = [
                    'data' => $user,
                    'message' => 'User address updated successfully',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'User address not updated',
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

    public function loginTestUser(Request $request)
    {
        $request->validate([
            'email' => $request->email,
            'password' => $request->password
        ]);
        try
        {
            $udata = TestUser::where('email', $request->email);
            $user = TestUser::where('email', $request->email)
                    ->where('password', Hash::check($request->password, $udata->password))
                    ->first();
            if ($user)
            {
                $result = [
                    'data' => $user,
                    'message' => 'Login successfully',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'Invalid Email or Password',
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

    public function registerTestUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        try
        {
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ];
            $user = TestUser::create($data);
            if ($user)
            {
                $result = [
                    'data' => $user,
                    'message' => 'User registered successfully',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'User not registered',
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

    public function fetchTestUser($phone)
    {
        try
        {
            $user = TestUser::where('phone', $phone)->get();
            if (count($user) == 0)
            {
                $result = [
                    'data' => NULL,
                    'message' => 'User not exist',
                    'status' => 200,
                    'error' => [
                        'message' => 'Server Error',
                        'code' => 305,
                    ]
                ];
            }
            else
            {
                $result = [
                    'data' => $user,
                    'message' => 'User fetched successfully',
                    'status' => 200,
                    'error' => NULL
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
