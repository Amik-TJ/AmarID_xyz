<?php

namespace App\Http\Controllers;

use App\Models\Assign_Vendor;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignDeliveryVendorController extends Controller
{
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


        $keyword = "Print Complete and Received";
        $print_done = DB::table('orders')
            ->join('users', 'orders.userID', '=', 'users.userID')
            ->join('packages', 'orders.packageID', '=', 'packages.packageID')
            ->where('orders.status', 'like', '%'.$keyword.'%')
            ->select('orders.orderID','orders.status','orders.userID','orders.packageID','orders.orderUrl','orders.placed','orders.glossy', 'packages.title', 'users.firstname','users.lastname')
            ->orderBy('orders.orderID', 'asc')
            ->get();


        if($print_done->isEmpty())
        {
            $data = array(
                'found'=>false,
                'vendor_found' => false
            );
            return view('admin.assign_delivery_vendor')->with('data',$data);
        }


        // Getting Print Vendor
        $delivery_vendor = User::where('delivery_vendor',1)
                        ->select('userID','firstname','lastname','email','phone','photo_url','delivery_vendor')
                        ->get();

        if($delivery_vendor->isEmpty())
        {
            $data = array(
                'found'=>true,
                'data' => $print_done,
                'vendor_found' => false
            );
        }
        else
        {
            $data = array(
                'found'=>true,
                'data' => $print_done,
                'vendor_found' => true,
                'vendor_info' => $delivery_vendor
            );
        }


        return view('admin.assign_delivery_vendor')->with('data',$data);

    }


    public function select_delivery_vendor(Request $request)
    {

        $delivery_vendor_id = $request->input('vendor_id');
        $order_id = $request->input('order_id');


        if ($delivery_vendor_id == 'false')
            return redirect('/assign_delivery_vendor')->with('error','Delivery Vendor is not Selected');






        // Get Vendor Information
        $vendor = User::find($delivery_vendor_id);
        $vendor_name = $vendor->firstname.' '.$vendor->lastname;

        // Assigning ID in Assign Vendor Table
        $assign_vendor = Assign_Vendor::find($order_id);
        $assign_vendor->delivery_vendor_id = $delivery_vendor_id;
        $assign_vendor->delivery_status = 0;
        $assign_vendor->save();


        // Update Order Table
        $order = Orders::find($order_id);
        $order->status = 'On Delivery';
        $order->save();


        return redirect('/assign_delivery_vendor')->with('success','Order no : '.$order_id.' assigned to --> '.$vendor_name);

    }
}
