<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CancelOrderController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function cancel_all_order()
    {
        $keyword = "To Pay";
        $cancel_all = DB::table('orders')
            ->where('status', $keyword)
            ->update(['status' => 'Canceled']);

        if($cancel_all)
            return redirect('/placed_order')->with('success','All Orders has been cancelled');
        else
            return redirect('/placed_order')->with('error','All Orders cannot be cancelled');
    }

    public function cancel_order(Request $request)
    {
        $order_id =  $request->input('orderID');
        $user_id = DB::table('orders')
            ->where('orderID',$order_id)
            ->select('userID')
            ->first();
        $user_id = $user_id->userID;


        // Getting User Credentials for Push Notification
        $user_info = DB::table('users')
            ->where('userID',$user_id)
            ->select('firebaseID','deviceID')
            ->first();
        $device_id = $user_info->deviceID;



        $order_update = DB::table('orders')
            ->where('orderID', $order_id)
            ->update(['status' => 'Canceled']);


        if($order_update)
        {
            // Inserting Data in Notification Table
            $notification_message = "Your Order No : '.$order_id.' has been Cancelled";
            $notification_code = 4.5;
            Helper::insert_notification($user_id,$notification_message,$notification_code);



            // Sending Push Notification
            if($device_id != null)
            {
                $push = new PushNotificationController();
                $push->push_notification_android($device_id,$notification_message, 4.5);
            }


            return redirect('/placed_order')->with('success','Order No : '.$order_id.' has been Cancelled');
        }

        else
            return redirect('/placed_order')->with('error','Order No : '.$order_id.' cannot be cancelled');
    }
}
