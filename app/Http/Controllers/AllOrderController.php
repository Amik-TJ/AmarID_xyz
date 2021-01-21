<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllOrderController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index(){

        // Getting All Data for All Orders
        $all_orders = DB::table('orders')
            ->join('users', 'orders.userID', '=', 'users.userID')
            ->join('packages', 'orders.packageID', '=', 'packages.packageID')
            ->select('orders.userID','orders.orderID','orders.packageID','orders.orderUrl','orders.status','orders.placed','orders.glossy', 'packages.title', )
            ->orderBy('orders.orderID', 'asc')
            ->get();

        /*echo "<pre>";
        print_r($all_orders);
        echo "</pre>";
        return;*/
        if($all_orders->isEmpty())
        {
            $data = array(
                'found'=>false
            );
            return view('admin.all_order')->with('data',$data);
        }
        $data = array(
            'found'=>true,
            'data' => $all_orders
        );
        return view('admin.all_order')->with('data',$data);
    }
}
