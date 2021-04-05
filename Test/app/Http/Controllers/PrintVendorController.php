<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrintVendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $vendor_id = Auth::id();
        $data = array(
            'found' => false
        );


        $all_order = DB::table('assign_vendor as av')
            ->join('orders as o','o.orderID','=','av.orderID')
            ->join('users as u', 'o.userID', '=', 'u.userID')
            ->join('packages as p', 'o.packageID', '=', 'p.packageID')
            ->where('av.print_vendor_id', Auth::id())
            ->select('o.orderID','o.status','o.userID','o.packageID','o.orderUrl','o.placed','o.glossy', 'p.title', 'u.firstname','u.lastname')
            ->orderBy('o.orderID', 'asc')
            ->get();

        if($all_order->isEmpty())
            return view('admin.print_vendor.print_vendor_all_order')->with('data',$data);


        $data = array(
            'found' => true,
            'data' => $all_order
        );
        return view('admin.print_vendor.print_vendor_all_order')->with('data',$data);

    }
}
