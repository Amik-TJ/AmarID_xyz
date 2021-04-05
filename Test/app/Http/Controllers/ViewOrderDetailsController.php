<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Packages;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class ViewOrderDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function view_order_details(Request $request)
    {
        $order_id = $request->input('order_id');
        $order = Orders::find($order_id);
        $package = Packages::find($order->packageID);


        $card_details = json_decode($order->json);
        $front_items = $card_details->frontItems;
        $back_items = $card_details->backItems;


        // Front Items
        if(!empty($front_items)){
            for($i=0; $i<count($front_items) ; $i++)
            {
                $front_array[$i] = json_decode($front_items[$i]);
            }
        }else
        {
            $front_array = false;
        }



        // Back Items
        if(!empty($back_items))
        {
            for($i=0; $i<count($back_items) ; $i++)
            {
                $back_array[$i] = json_decode($back_items[$i]);
            }

        }else
        {
            $back_array = false;
        }


        // Card Template
        if($card_details->cardTemplate)
        {
            $card_template = json_decode($card_details->cardTemplate);
        }else
        {
            $card_template = false;
        }



        $data = array(
            'front_array' => $front_array,
            'back_array' => $back_array,
            'card_template' => $card_template,
            'order' => $order,
            'package' => $package,
        );




        return view('admin.view_order_details')->with('data',$data);

    }
}


