<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class RevenueForecastController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        // Getting All Data for Revenue Fore Casting
        //$keyword = 'Delivered';
        $revenue_forecast = DB::table('orders as o')
            ->join('users as u', 'o.userID', '=', 'u.userID')
            ->join('packages as p', 'o.packageID', '=', 'p.packageID')
            ->join('payments as py', 'o.orderID', '=', 'py.orderID')
            ->leftJoin('payment_options as po', 'po.optionID', '=', 'py.optionID')
            //->where('o.status', 'like', '%'.$keyword.'%')
            ->select('o.orderID','o.status','o.placed as order_date','o.userID','u.firstname','u.lastname','p.hardCopyIncluded','p.noOfSoftID', 'o.packageID', 'po.name as payment_method','py.txID','o.total_price')
            ->orderBy('o.orderID', 'asc')
            ->get();

       /* echo "<pre>";
        print_r($all_orders);
        echo "</pre>";
        return;*/
        if($revenue_forecast->isEmpty())
        {
            $data = array(
                'found'=>false
            );
            return view('admin.revenue_forecast')->with('data',$data);
        }
        $data = array(
            'found'=>true,
            'data' => $revenue_forecast
        );
        return view('admin.revenue_forecast')->with('data',$data);
    }



    public function make_order_invoice(Request $request)
    {
        $user_id = $request->input('user_id');
        $order_id = $request->input('order_id');


        $order= DB::table('orders as o')
            ->where('o.orderID',$order_id)
            ->join('users as u', 'o.userID', '=', 'u.userID')
            ->join('delivery_address as d', 'd.orderID', '=', 'o.orderID')
            ->join('packages as p', 'o.packageID', '=', 'p.packageID')
            ->join('payments as py', 'o.orderID', '=', 'py.orderID')
            ->leftJoin('payment_options as po', 'po.optionID', '=', 'py.optionID')
            //->where('o.status', 'like', '%'.$keyword.'%')
            ->select('o.orderID','o.placed as order_date','u.firstname','u.lastname','p.title as package_title','p.description','p.discount','p.price as package_price', 'po.name as payment_method','py.amount as amount_received','py.paymentStatus as payment_status','py.time as payment_time','py.txID','o.total_price','d.label','d.address','d.phone as delivery_phone')
            ->first();



        return view('admin.cashmemo')->with('data',$order);
    }

    /*public function download_order_invoice($order_id)
    {


        $data = DB::table('orders as o')
            ->where('o.orderID',$order_id)
            ->join('users as u', 'o.userID', '=', 'u.userID')
            ->join('delivery_address as d', 'd.orderID', '=', 'o.orderID')
            ->join('packages as p', 'o.packageID', '=', 'p.packageID')
            ->join('payments as py', 'o.orderID', '=', 'py.orderID')
            ->leftJoin('payment_options as po', 'po.optionID', '=', 'py.optionID')
            //->where('o.status', 'like', '%'.$keyword.'%')
            ->select('o.orderID','o.placed as order_date','u.firstname','u.lastname','p.title as package_title','p.description','p.discount','p.price as package_price', 'po.name as payment_method','py.amount as amount_received','py.paymentStatus as payment_status','py.time as payment_time','py.txID','o.total_price','d.label','d.address','d.phone as delivery_phone')
            ->first();


        $pdf = PDF::setPaper('a4', 'portrait')->loadView('admin.cashmemo',compact('data'));
        return $pdf->download('order.pdf');
    }*/
}
