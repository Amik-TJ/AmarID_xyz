<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveredOrder extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index()
    {
        $keyword = "Delivered";
        $delivered = DB::table('orders')
            ->join('users', 'orders.userID', '=', 'users.userID')
            ->join('packages', 'orders.packageID', '=', 'packages.packageID')
            ->where('orders.status', 'like', '%'.$keyword.'%')
            ->select('orders.orderID','orders.orderUrl','orders.placed','orders.glossy', 'packages.title', 'users.firstname','users.lastname')
            ->orderBy('orders.orderID', 'asc')
            ->get();
        if($delivered->isEmpty())
        {
            $data = array(
                'found'=>false
            );
            return view('admin.delivered_order')->with('data',$data);
        }
        $data = array(
            'found'=>true,
            'data' => $delivered
        );
        return view('admin.delivered_order')->with('data',$data);

    }
}
