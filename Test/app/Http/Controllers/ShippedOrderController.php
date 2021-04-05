<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Assign_Vendor;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShippedOrderController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index()
    {
        if(auth()->user()->delivery_vendor)
        {
            $keyword = "On Delivery";
            $shipped_orders = DB::table('orders as o')
                ->join('assign_vendor as av','o.orderID','=','av.orderID')
                ->join('users as u', 'o.userID', '=', 'u.userID')
                ->join('packages as p', 'o.packageID', '=', 'p.packageID')
                ->where('av.delivery_vendor_id', Auth::id())
                ->where('o.status', 'like', '%'.$keyword.'%')
                ->select('o.orderID','o.status','o.userID','o.packageID','o.orderUrl','o.placed','o.glossy', 'p.title', 'u.firstname','u.lastname')
                ->orderBy('o.orderID', 'asc')
                ->get();

            if($shipped_orders->isEmpty())
            {
                $data = array(
                    'found'=>false
                );
                return view('admin.shipped_order')->with('data',$data);
            }
            $data = array(
                'found'=>true,
                'data' => $shipped_orders
            );
            return view('admin.shipped_order')->with('data',$data);

        }

        $keyword = "On Delivery";
        $shipped_orders = DB::table('orders')
            ->join('users', 'orders.userID', '=', 'users.userID')
            ->join('packages', 'orders.packageID', '=', 'packages.packageID')
            ->where('orders.status', 'like', '%'.$keyword.'%')
            ->select('orders.orderID','orders.status','orders.userID','orders.packageID','orders.orderUrl','orders.placed','orders.glossy', 'packages.title', 'users.firstname','users.lastname')
            ->orderBy('orders.orderID', 'asc')
            ->get();


        if($shipped_orders->isEmpty())
        {
            $data = array(
                'found'=>false
            );
            return view('admin.shipped_order')->with('data',$data);
        }


        $data = array(
            'found'=>true,
            'data' => $shipped_orders
        );
        return view('admin.shipped_order')->with('data',$data);

    }


    public function mark_as_shipped(Request $request)
    {


        // Catching Data From View
        $order_id = $request->input('orderID');
        $user_id = $request->input('userID');


        // Updating Assign Vendor Table
        $assign_vendor = Assign_Vendor::find($order_id);
        if($assign_vendor == null)
            return redirect('/shipped_order')->with('error', 'Delivery Vendor not assigned yet for OrderID No : '.$order_id);
        $assign_vendor->delivery_status = 1;
        $assign_vendor->save();


        // Getting User Credentials for Push Notification
        $user_info = DB::table('users')
            ->where('userID',$user_id)
            ->select('firebaseID','deviceID')
            ->first();


        // Updating Order Table for Status
        $order_update = DB::table('orders')
            ->where('orderID', $order_id)
            ->update(['status' => 'Delivered']);


        // Inserting Data in Notification Table
        $notification_message = "Your Order no : ".$order_id." has been Delivered. Thanks For Choosing AmarID.xyz";
        $notification_code = 4.4;
        Helper::insert_notification($user_id,$notification_message,$notification_code);


        // Inserting Notification for Admin
        $notification_message = 'Delivery Vendor has successfully delivered Order no : '.$order_id;
        $notification_code = 4.4;
        Helper::insert_notification(-1,$notification_message,$notification_code);



        // Sending Push Notification for Admin
        Helper::admin_push_notification($notification_message,$notification_code);


        // Sending Push Notification
        if($user_info->deviceID != null)
        {
            $push = new PushNotificationController();
            $push->push_notification_android($user_info->deviceID,$notification_message,4.4);
        }

        return redirect('/shipped_order')->with('success', 'OrderID No : '.$order_id.' marked as Delivered');
    }

}
