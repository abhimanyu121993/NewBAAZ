<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Customer;

use App\Models\CustomNotification;

class NotificationController extends Controller
{
    public function Notification()
    {
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

              $this->sendNotification($to, $data);

            }
            if ($notif) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Notification Send successfully'
                ]);
            }
        }
    }

    function sendNotification($to, $data)
    {
        $api_key = "AAAASgVs7Ks:APA91bGhJ6fXogS68QeEB2kzeINTgqgylvuPfdF9hAZJ8DIiRqE3uQvYQFHEByaKpPUMMGd78-6yKCNjlxrJpyDmCYPgxFQGxXp4bdD05dEE7YJS56Rc4sD_7-VCub14qYVORYTrr515";
        $url = "https://fcm.googleapis.com/fcm/send";
        $fields = json_encode(array('to' => $to, 'notification' => $data));
        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($fields));

        $headers = array();
        $headers[] = 'Authorization: key =' . $api_key;
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }


    public function  Notification_list()
    {
        $notif = CustomNotification::all();
        return view('Backend.custom_notification', compact('notif'));
    }







        public function Edit_Notification($id)
        {
            // try {
                if (CustomNotification::where("id", $id)->exists()) {
                    $notif = CustomNotification::find($id);
                    return response()->json([
                        'status' => 200,
                        'success' => $notif
                    ]);
                }

        }


        public function Update_Notification(Request $request, $id)
        {

                if (CustomNotification::where("id", $id)->exists()) {
                    $validator = Validator::make($request->all(), [
                        'title' => 'required|max:50',
                        'body'  => 'required|max:191',
                    ]);
                    if ($validator->fails()) {
                        return response()->json([
                            'status' => 400,
                            'errors' => $validator->message()
                        ]);
                    } else {

                        $notif = CustomNotification::find($id);
                        $notif->title   = $request->input('title');
                        $notif->body   = $request->input('body');
                        $notif->notification_type = "custom_notification";
                         $notif->update();
                            $fcmTokens = Customer::all();
                        foreach ($fcmTokens as $fcmTokens) {
                            $to = $fcmTokens->fcm_token;

                        $data = array(
                        'title' => $request->title,
                        'body' => $request->body,

                    );
                    $this->sendNotification($to, $data);

                        }

                        if ($notif) {
                            return response()->json([
                                'status' => 200,
                                'message' => 'Resend Notification successfully'
                            ]);
                        }
                    }
                } else {
                    return response()->json([
                        'status' => 419,
                        'error' => "Sorry  not found"
                    ]);
                }

        }





        public function delete($id){
          $delete = CustomNotification::find($id);
         $delete->delete();
         return response()->json(['success'=>'Deleted Successfully!']);



}
}
