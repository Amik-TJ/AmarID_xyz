<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VerifyOrderController extends Controller
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = array(
            'found' => false,
            'excess_amount' => false,
        );




        $keyword= "On Verification";
        $verify_orders = DB::table('orders')
            ->join('packages', 'orders.packageID', '=', 'packages.packageID')
            ->join('payments', 'payments.orderID', '=', 'orders.orderID')
            ->where('orders.status', 'like', '%'.$keyword.'%')
            ->orderBy('orders.orderID', 'asc')
            ->get();



        if($verify_orders->isEmpty())
            return view('admin.verify_order')->with('data',$data);


        $options = DB::table('payment_options')->get();
        $data = array(
            'found' => true,
            'order_details' => $verify_orders,
            'options' => $options,
            'excess_amount' => false
        );
        return view('admin.verify_order')->with('data',$data);
    }



    public function price_verify(Request $request)
    {

        $user_id = $request->input('userID');
        $order_id = $request->input('orderID');
        $package_id = $request->input('packageID');
        $payment_id = $request->input('paymentID');
        $hard_copy_included = $request->input('hardCopyIncluded');
        $amount = $request->input('amount');
        $by_pass = $request->input('by_pass');



        // Getting User Credentials for Push Notification
        $user_info = DB::table('users')
            ->where('userID',$user_id)
            ->select('firebaseID','deviceID')
            ->first();



        // Package Information
        $packages = DB::table('packages')->where('packageID',$package_id)->get()->first();



        // Price Information
        $orders = DB::table('orders')->where('orderID',$order_id)->get()->first();
        if($amount < $orders->total_price)
            return redirect('/verify_orders')->with('error','Order no: '.$order_id.' cannot be verified because of Insufficient Amount');






        // Verifying if amount is more than the actual price
        if(($amount > $orders->total_price) && $by_pass == '0')
        {

            $data = array(
                'found' => false,
                'excess_amount' => false,
            );


            $keyword= "On Verification";
            $verify_orders = DB::table('orders')
                ->join('packages', 'orders.packageID', '=', 'packages.packageID')
                ->join('payments', 'orders.orderID', '=', 'payments.orderID')
                ->where('orders.status', 'like', '%'.$keyword.'%')
                ->orderBy('orders.orderID', 'asc')
                ->get();


            if($verify_orders->isEmpty())
                return view('admin.verify_order')->with('data',$data);


            $options = DB::table('payment_options')->get();
            $data = array(
                'found' => true,
                'order_details' => $verify_orders,
                'options' => $options,
                'excess_amount' => true,
                'entered_amount' => $amount,
                'actual_amount' => $orders->total_price,
                'order_id' => $order_id,
                'user_id' =>$user_id,
                'package_id' => $package_id,
                'payment_id' => $payment_id,
                'hard_copy_included' => $hard_copy_included
            );


            return view('admin.verify_order')->with('data',$data);

        }


        // Updating Payments Table
        $update_data = array(
            'amount' => $amount,
            'paymentStatus' => 'Payment Done',
            'updated' => now()
        );
        $payment_update = DB::table('payments')
                        ->where('paymentID', $payment_id)
                        ->update($update_data);


        // Update order for only Soft Copy
        if($hard_copy_included == 0)
        {
            $order_update = DB::table('orders')
                ->where('orderID', $order_id)
                ->update(['status' => 'Delivered']);


            // Inserting Data in Notification Table
            $notification_message = "Your Order Has been Delivered";
            $notification = new Notifications();
            $notification->userID = $user_id;
            $notification->message = $notification_message;
            $notification->type = 7; // Type 7 for delivered
            $notification->time = now();
            $notification->seen = 0;
            $notification->save();

            // Sending Push Notification
            if($user_info->deviceID != null)
            {
                $push = new PushNotificationController();
                $push->push_notification_android($user_info->deviceID,$notification_message);
            }

            // Adding SoftID information into Card Registration Table
            if($packages->noOfSoftID>0)
            {

                $card = DB::table('card_registration')
                    ->where('userID', $user_id)
                    ->first();
                $card_registration_data = array(
                    'softID' => ($card->softID + $packages->noOfSoftID)
                );
                DB::table('card_registration')
                    ->where('userID', $user_id)
                    ->update($card_registration_data);
            }

            return redirect('/verify_orders')->with('success','Payment Verified for Order no: '.$order_id);
        }

        // Updating Order Table for HardCopy Available Items
        $order_update = DB::table('orders')
            ->where('orderID', $order_id)
            ->update(['status' => 'Verification Done']);



        // Inserting Data in Notification Table
        $notification_message = "Your Order is Verified and Under Processing";
        $notification = new Notifications();
        $notification->userID = $user_id;
        $notification->message = $notification_message;
        $notification->type = 4.2; // Type 5 for Processing
        $notification->time = now();
        $notification->seen = 0;
        $notification->save();

        // Sending Push Notification
        if($user_info->deviceID != null)
        {
            $push = new PushNotificationController();
            $push->push_notification_android($user_info->deviceID,$notification_message,4.2);
        }


        // Adding SoftID information into Card Registration Table
        if($packages->noOfSoftID>0)
        {

            $card = DB::table('card_registration')
                ->where('userID', $user_id)
                ->first();
            $card_registration_data = array(
                'softID' => ($card->softID + $packages->noOfSoftID)
            );
            DB::table('card_registration')
                ->where('userID', $user_id)
                ->update($card_registration_data);
        }

        return redirect('/verify_orders')->with('success','Payment Verified for Order no: '.$order_id);
    }
}
