<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user_id = auth()->user()->userID;
        // Get Messages of User
        $messages_data = Helper::get_user_messages($user_id);
        // Get user Notifications
        $notification_data = Helper::get_user_notifications($user_id);
        /*session(
            [
                'message_data' => $messages_data,
                'notification_data' => $notification_data,
            ]);*/


        // Getting Orders Information
        $latest_orders = DB::table('orders as o')
            ->join('packages', 'o.packageID', '=', 'packages.packageID')
            ->select('o.userID','o.orderID','o.packageID','o.orderUrl','o.status','o.placed','o.glossy', 'packages.title')
            ->where('o.userID',$user_id)
            ->orderBy('o.placed', 'desc')
            ->get();


        if($latest_orders->isEmpty())
        {
            $data = array(
                'found' =>false,
                'total_order' => 0,
                'to_pay'=>0,
                'on_verification' => 0,
                'Processing' => 0,
                'on_delivery' => 0,
                'delivered' => 0,
                'messages_data' => $messages_data,
            );
        }else{
            $total_order = $latest_orders->count();
            $to_pay = $latest_orders->where('status', 'To Pay')->count();
            $on_verification = $latest_orders->where('status', 'On Verification')->count();





            // User should consider this steps under Processing Stage
            $verification_done = $latest_orders->where('status', 'Verification Done')->count();
            $processing  = $latest_orders->where('status', 'Processing')->count();
            $print_vendor_assigned = $latest_orders->where('status', 'Print Vendor Assigned')->count();
            $print_done = $latest_orders->where('status', 'Print Done')->count();
            $print_complete_and_received = $latest_orders->where('status', 'Print Complete and Received')->count();
            $assign_delivery_vendor = $latest_orders->where('status', 'Assign Delivery Vendor')->count();
            // Total Orders Under Processing
            $processing = $processing + $print_vendor_assigned + $print_done + $print_complete_and_received + $assign_delivery_vendor + $verification_done;


            $on_delivery = $latest_orders->where('status', 'On Delivery')->count();
            $delivered = $latest_orders->where('status', 'Delivered')->count();



            $data = array(
                'found' =>true,
                'total_order' => $total_order,
                'to_pay'=>$to_pay,
                'on_verification' => $on_verification,
                'Processing' => $processing,
                'on_delivery' => $on_delivery,
                'delivered' => $delivered,
                'latest_orders' => $latest_orders,
                'messages_data' => $messages_data,
            );



        }





        return view('user.user_dashboard')->with('data',$data);
    }
}

