<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashBoardController extends Controller
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


        // Getting Active Users
        $active_users = User::where('active',1)->get();
        if($active_users->isEmpty())
            $active_users = 0;
        else
            $active_users = $active_users->count();



        // Getting Orders Information
        $orders = Orders::get();

        $latest_orders = DB::table('orders as o')
            ->join('users as u', 'o.userID', '=', 'u.userID')
            ->join('packages', 'o.packageID', '=', 'packages.packageID')
            ->select('o.userID','o.orderID','o.packageID','o.orderUrl','o.status','o.placed','o.glossy', 'packages.title', 'u.firstname','u.lastname','u.photo_url')
            ->orderBy('o.placed', 'desc')
            ->take(10)
            ->get();


        if($orders->isEmpty())
        {
            $data = array(
                'found' =>false,
                'active_users' => $active_users,
                'total_order' => 0,
                'to_pay'=>0,
                'on_verification' => 0,
                'verification_done' => 0,
                'print_vendor_assigned' => 0,
                'Processing' => 0,
                'print_done' => 0,
                'print_complete_and_received' => 0,
                'assign_delivery_vendor' => 0,
                'on_delivery' => 0,
                'delivered' => 0,
                'revenue_delivered'=>0,
                'revenue_all' => 0
            );
        }else{
            $total_order = $orders->count();
            $to_pay = $orders->where('status', 'To Pay')->count();
            $on_verification = $orders->where('status', 'On Verification')->count();
            $verification_done = $orders->where('status', 'Verification Done')->count();
            $print_vendor_assigned = $orders->where('status', 'Print Vendor Assigned')->count();
            $processing  = $orders->where('status', 'Processing')->count();
            $print_done = $orders->where('status', 'Print Done')->count();
            $print_complete_and_received = $orders->where('status', 'Print Complete and Received')->count();
            $assign_delivery_vendor = $orders->where('status', 'Assign Delivery Vendor')->count();
            $on_delivery = $orders->where('status', 'On Delivery')->count();
            $delivered = $orders->where('status', 'Delivered')->count();
            $revenue_delivered = $orders->where('status', 'Delivered')->sum('total_price');
            $revenue_all = $orders->sum('total_price');


            $data = array(
                'found' =>true,
                'active_users' => $active_users,
                'total_order' => $total_order,
                'to_pay'=>$to_pay,
                'on_verification' => $on_verification,
                'verification_done' => $verification_done,
                'print_vendor_assigned' => $print_vendor_assigned,
                'Processing' => $processing,
                'print_done' => $print_done,
                'print_complete_and_received' => $print_complete_and_received,
                'assign_delivery_vendor' => $assign_delivery_vendor,
                'on_delivery' => $on_delivery,
                'delivered' => $delivered,
                'revenue_delivered'=>$revenue_delivered,
                'revenue_all' => $revenue_all,
                'latest_orders' => $latest_orders
            );
        }





        return view('admin.dashboard')->with('data',$data);
    }
}
