<?php

namespace App\Http\Controllers;

use App\Models\Assign_Vendor;
use App\Models\Notifications;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignPrintVendorController extends Controller
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


        $keyword = "Verification Done";
        $on_print = DB::table('orders')
            ->join('users', 'orders.userID', '=', 'users.userID')
            ->join('packages', 'orders.packageID', '=', 'packages.packageID')
            ->where('orders.status', 'like', '%'.$keyword.'%')
            ->select('orders.orderID','orders.status','orders.userID','orders.packageID','orders.orderUrl','orders.placed','orders.glossy', 'packages.title', 'users.firstname','users.lastname')
            ->orderBy('orders.orderID', 'asc')
            ->get();


        if($on_print->isEmpty())
        {
            $data = array(
                'found'=>false,
                'vendor_found' => false
            );
            return view('admin.assign_print_vendor')->with('data',$data);
        }


        // Getting Print Vendor
        $print_vendor = User::where('print_vendor',1)
            ->select('userID','firstname','lastname','email','phone','photo_url','print_vendor')
            ->get();

        if($print_vendor->isEmpty())
        {
            $data = array(
                'found'=>true,
                'data' => $on_print,
                'vendor_found' => false
            );
        }
        else
        {
            $data = array(
                'found'=>true,
                'data' => $on_print,
                'vendor_found' => true,
                'vendor_info' => $print_vendor
            );
        }


        return view('admin.assign_print_vendor')->with('data',$data);

    }


    public function select_print_vendor(Request $request)
    {

        $print_vendor_id = $request->input('vendor_id');
        $order_id = $request->input('order_id');


        if ($print_vendor_id == 'false')
            return redirect('/assign_print_vendor')->with('error','Print Vendor is not Selected');




        // Get Vendor Information
        $vendor = User::find($print_vendor_id);
        $vendor_name = $vendor->firstname.' '.$vendor->lastname;

        // Assigning ID in Assign Vendor Table
        $assign_vendor = new Assign_Vendor();
        $assign_vendor->orderID = $order_id;
        $assign_vendor->print_vendor_id = $print_vendor_id;
        $assign_vendor->print_processing = 0;
        $assign_vendor->print_done = 0;
        $assign_vendor->save();


        // Update Order Table
        $order = Orders::find($order_id);
        $order->status = 'Print Vendor Assigned';
        $order->save();


        // Sending Notification for Print Vendor
        $print_vendor_device_id = User::where('userID',$print_vendor_id)->select('deviceID')->first();
        $notification_message = 'You have received a new Print Job || Order ID : '.$order_id;
        $notification = new Notifications();
        $notification->userID = $print_vendor_id;
        $notification->message = $notification_message;
        $notification->type = 4.2;
        $notification->time = now();
        $notification->seen = 0;
        $notification->save();


        // Sending Push Notification
        if($print_vendor_device_id != null)
        {
            $push = new PushNotificationController();
            $push->push_notification_android($print_vendor_device_id,$notification_message, 4.2);
        }

        return redirect('/assign_print_vendor')->with('success','Order no : '.$order_id.' assigned to --> '.$vendor_name);

    }
}
