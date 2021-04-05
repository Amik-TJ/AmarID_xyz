<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlacedOrderController extends Controller
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
        $to_pay = "To Pay";
        $placed_orders = DB::table('orders')
            ->join('users', 'orders.userID', '=', 'users.userID')
            ->join('packages', 'orders.packageID', '=', 'packages.packageID')
            ->where('orders.status', 'like', '%'.$to_pay.'%')
            ->select('orders.orderID','orders.userID','orders.packageID','orders.orderUrl','orders.placed','orders.glossy', 'packages.title', 'users.firstname','users.lastname')
            ->orderBy('orders.orderID', 'asc')
            ->get();
        /*echo "<pre>";
        print_r($placed_orders);
        echo "</pre>";
        return;*/
        if($placed_orders->isEmpty())
        {
            $data = array(
                'found'=>false
            );
            return view('admin.placed_order')->with('data',$data);
        }
        $data = array(
            'found'=>true,
            'data' => $placed_orders
        );
        return view('admin.placed_order')->with('data',$data);

    }
}
