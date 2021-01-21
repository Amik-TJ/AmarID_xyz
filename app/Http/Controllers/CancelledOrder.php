<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CancelledOrder extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index()
    {
        $keyword = "Canceled";
        $cancelled = DB::table('orders')
            ->join('users', 'orders.userID', '=', 'users.userID')
            ->join('packages', 'orders.packageID', '=', 'packages.packageID')
            ->where('orders.status', 'like', '%'.$keyword.'%')
            ->select('orders.orderID','orders.orderUrl','orders.placed','orders.glossy', 'packages.title', 'users.firstname','users.lastname')
            ->orderBy('orders.orderID', 'asc')
            ->get();
        if($cancelled->isEmpty())
        {
            $data = array(
                'found'=>false
            );
            return view('admin.cancelled_order')->with('data',$data);
        }
        $data = array(
            'found'=>true,
            'data' => $cancelled
        );
        return view('admin.cancelled_order')->with('data',$data);

    }
}
