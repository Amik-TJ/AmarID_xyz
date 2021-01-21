<?php

namespace App\Http\Controllers;

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
}
