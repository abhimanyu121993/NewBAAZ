<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Category;
use App\Models\Error;
use App\Models\FuelType;
use App\Models\HomeSlider;
use App\Models\OfferBanner;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Slot;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    public function brand()
    {
        try
        {
            $brand = Brand::get();
            if ($brand)
            {
                $result = [
                    'data' => $brand,
                    'message' => 'Company details found',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'Company details not found',
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

    public function brandModel(Request $req)
    {
        $req->validate([
            'company_id' => 'required'
        ]);
        try
        {
            $model = Brand::find($req->company_id);
            if ($model)
            {
                $result = [
                    'data' => $model->models,
                    'message' => 'Brand model details found',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'Brand details not found',
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

    public function fuelType()
    {
        try
        {
            $fuelType = FuelType::get();
            if ($fuelType)
            {
                $result = [
                    'data' => $fuelType,
                    'message' => 'Fuel type found',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'Fuel type not found',
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

    public function category()
    {
        try
        {
            $category = Category::get();
            if ($category)
            {
                $result = [
                    'data' => $category,
                    'message' => 'Category details found',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'Category details not found',
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

    public function services(Request $req)
    {
        $req->validate([
            'category_id' => 'required',
            'model_id' => 'required'
        ]);
        try
        {
            $services = DB::table('categories as c')
                ->select('msm.service_id as service_id', 'msm.price as service_price', 's.name as service_name', 's.image as service_image')
                ->join('services as s', 's.cid', 'c.id')
                ->join('model_service_maps as msm', 'msm.service_id', 's.id')
                ->join('brand_models as bm', 'bm.id', 'msm.model_id')
                ->where('c.id', $req->category_id)
                ->where('msm.model_id', $req->model_id)
                ->get();
            if ($services)
            {
                $result = [
                    'data' => $services->services,
                    'message' => 'Services found',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'Services not found',
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

    public function homeSlider()
    {
        try
        {
            $slider = HomeSlider::all();
            if ($slider)
            {
                $result = [
                    'data' => $slider,
                    'message' => 'Slider details found',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'Slider details not found',
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

    public function offerBanner()
    {
        try
        {
            $offerBanner = OfferBanner::get();
            if ($offerBanner)
            {
                $result = [
                    'data' => $offerBanner,
                    'message' => 'Company details found',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'Company details not found',
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

    public function fetchSlot()
    {
        try
        {
            $slot = Slot::get();
            if ($slot)
            {
                $result = [
                    'data' => $slot,
                    'message' => 'Slot details found',
                    'status' => 200,
                    'error' => NULL
                ];
            }
            else
            {
                $result = [
                    'data' => NULL,
                    'message' => 'Slot details not found',
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
