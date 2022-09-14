<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomNotification;

class NotificationController extends Controller
{
    public function Notification(){
       return view('Backend.custom_notification'); 
    }

     public function Add_Notification(Request $request)
     {
         
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
            'body'  => 'required|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {

            $notif = new CustomNotification();
            $notif->title   = $request->input('title');
            $notif->body   = $request->input('body');
            $notif->notification_type = "custom_notification";      
            $notif->save();
            $fcmTokens = Customer::all();
            foreach ($fcmTokens as $fcmTokens) {
                $to = $fcmTokens->fcm_token;
                $data = array(
                    'title' => $request->title,
                    'body' => $request->body,

                );
                sendNotification($to, $data);
            }
            if ($notif) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Notification Send successfully'
                ]);
            }
        }

}

   public function  Notification_list(){
    $notif = CustomNotification::all(); 
    return view('Backend.custom_notification',compact('notif'));
   }




}

        

    
 