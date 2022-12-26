<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FooterSlider;
class ApIController extends Controller
{
    public function Footer_Slider()
    {
        $footer = FooterSlider::orderBy('created_at', 'DESC')
                ->select("id", "title", "image")
                   ->get();
                   if ($footer)
                   {
                       $result = [
                           'data' => $footer,
                           'message' => 'Footer Slider Fetched Successfully',
                           'status' => 200,
                           'error' => NULL
                       ];
                   }
                   else
                   {
                       $result = [
                           'data' => NULL,
                           'message' => 'Footer Slider Not Found',
                           'status' => 200,
                           'error' => [
                               'message' => 'Data Not Found',
                               'code' => 404,
                           ]
                       ];
                   }
                   return response()->json($result);

    }
}
