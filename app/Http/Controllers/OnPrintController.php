<?php

namespace App\Http\Controllers;

use App\Models\Assign_Vendor;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OnPrintController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        if(auth()->user()->print_vendor)
        {
            $keyword_1 = "Print Vendor Assigned";
            $keyword_2 = "Processing";
            $on_print = DB::table('orders as o')
                ->join('assign_vendor as av','o.orderID','=','av.orderID')
                ->join('users as u', 'o.userID', '=', 'u.userID')
                ->join('packages as p', 'o.packageID', '=', 'p.packageID')
                ->where('av.print_vendor_id', Auth::id())
                ->where('o.status', 'like', '%'.$keyword_1.'%')
                ->orWhere('o.status', 'like', '%'.$keyword_2.'%')
                ->select('o.orderID','o.userID','o.status','o.packageID','o.orderUrl','o.placed','o.glossy', 'p.title', 'u.firstname','u.lastname')
                ->orderBy('o.orderID', 'asc')
                ->get();

            if($on_print->isEmpty())
            {
                $data = array(
                    'found'=>false
                );
                return view('admin.on_print')->with('data',$data);
            }
            $data = array(
                'found'=>true,
                'data' => $on_print
            );
            return view('admin.on_print')->with('data',$data);

        }
        $keyword_1 = "Print Vendor Assigned";
        $keyword_2 = "Processing";
        $keyword_3 = "Print Done";
        $on_print = DB::table('orders')
            ->join('users', 'orders.userID', '=', 'users.userID')
            ->join('packages', 'orders.packageID', '=', 'packages.packageID')
            ->where('orders.status', 'like', '%'.$keyword_1.'%')
            ->orWhere('orders.status', 'like', '%'.$keyword_2.'%')
            ->orWhere('orders.status', 'like', '%'.$keyword_3.'%')
            ->select('orders.orderID','orders.status','orders.userID','orders.packageID','orders.orderUrl','orders.placed','orders.glossy', 'packages.title', 'users.firstname','users.lastname')
            ->orderBy('orders.orderID', 'asc')
            ->get();


        if($on_print->isEmpty())
        {
            $data = array(
                'found'=>false
            );
            return view('admin.on_print')->with('data',$data);
        }


        $data = array(
            'found'=>true,
            'data' => $on_print
        );


        return view('admin.on_print')->with('data',$data);

    }


    public function print_change_status(Request $request)
    {


        // Catching Data From View
        $order_id = $request->input('orderID');
        $user_id = $request->input('userID');
        $status = $request->input('change_status');


        // Updating Assign Vendor Table
        $assign_vendor = Assign_Vendor::find($order_id);

        // Checking Assign Vendor is null or not
        if($assign_vendor == null)
            return redirect('/on_print')->with('error', 'Print Vendor not assigned yet for OrderID No : '.$order_id);


        if($status == 'Processing')
            $assign_vendor->print_processing = 1;
        elseif ($status == 'Print Done')
            $assign_vendor->print_done = 1;
        $assign_vendor->save();



        // Updating Order Table for Status
        $order_update = DB::table('orders')
            ->where('orderID', $order_id)
            ->update(['status' => $status]);





        // Sending Customer Push Notification when only Print Done And Recieved
        if($status == 'Print Complete and Received')
        {
            // Getting User Credentials for Push Notification
            $user_info = DB::table('users')
                ->where('userID',$user_id)
                ->select('firebaseID','deviceID')
                ->first();



            // Inserting Data in Notification Table
            $notification_message = "Your Order has been Prepared and On the way for Shipping. Thanks For Choosing AmarID.xyz";
            $notification = new Notifications();
            $notification->userID = $user_id;
            $notification->message = $notification_message;
            $notification->type = 6; // Type 6 for Shipped
            $notification->time = now();
            $notification->seen = 0;
            $notification->save();


            // Sending Push Notification
            if($user_info->deviceID != null)
            {
                $push = new PushNotificationController();
                $push->push_notification_android($user_info->deviceID,$notification_message);
            }
        }


        return redirect('/on_print')->with('success', 'OrderID No : '.$order_id.' marked as '.$status);
    }
}
