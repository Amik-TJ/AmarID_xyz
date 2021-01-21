<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DeliveryAddress;
use App\Models\Orders;
use App\Models\Predesigned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Flysystem\File;

class RemoteRequestController extends Controller
{

    public function upload_design(Request $request)
    {
        $front = $request->input('front');
        $back = $request->input('back');
        $json = $request->input('json');
        $name = $request->input('name');



        $extension_f = Helper::get_extension($front);
        $front = Helper::get_image($front);

        $extension_b = Helper::get_extension($back);
        $back = Helper::get_image($back);




        // File Name
        $front_name = 'front.'.$extension_f;
        $back_name = 'back.'.$extension_b;
        // Upload Directory
        $upload_dir = 'uploads/designs/'.$name.'/';
        $front_url = $upload_dir.$front_name;
        $back_url = $upload_dir.$back_name;



        $front_status = Storage::disk('public')->put($front_url, $front,'public');
        $back_status = Storage::disk('public')->put($back_url, $back,'public');
        if($front_status && $back_status){
            $predesigned = new Predesigned();
            $predesigned->json = $json;
            $predesigned->frontUrl = $front_url;
            $predesigned->backUrl = $back_url;
            $predesigned->save();
            return "Uploaded Successfully. ";
        }
        else
            return "Image cannot be uploaded";

    }


    public function upload_image(Request $request)
    {
        $image = $request->input('image');
        $name = $request->input('name');
        $message_photo = $request->input('message_photo');
        $real_image = base64_decode($image);

        //return gettype($image);
        if ($message_photo == "1"){
            $upload_dir = '/uploads/messages/'.$name;
        }
        else{
            $upload_dir = '/uploads/photos/'.$name;
        }

        //your base64 encoded data

        $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];   // .jpg .png .pdf
        $replace = substr($image, 0, strpos($image, ',')+1);
        $image = str_replace($replace, '', $image);
        $image = str_replace(' ', '+', $image);
        $image = base64_decode($image);

        //$imageName = Str::random(10).'.'.$extension;

        $status = Storage::disk('public')->put($upload_dir, $image);
        if($status)
            return "Image Uploaded Successfully. ";
        else
            return "Image cannot be uploaded";

    }


    public function place_order(Request $request)
    {
        $front = $request->input('front');
        $back = $request->input('back');
        $user_id = $request->input('user_id');
        $package_id = $request->input('package_id');
        $glossy = $request->input('glossy');
        $spot = $request->input('glossy');
        $rounded = $request->input('rounded');
        $total_price = $request->input('total_price');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $label = $request->input('label');
        $json = $request->input('json');


        /// Kahini Ase
        $images = json_decode($request->input('images'));



        $orders = new Orders();
        $orders->userID = $user_id;
        $orders->packageID = $package_id;
        $orders->glossy = $glossy;
        $orders->spot = $spot;
        $orders->rounded = $rounded;
        $orders->total_price = $total_price;
        $orders->json = $json;
        $orders->save();
        $order_id =  $orders->orderID;



        // Image Processing
        $extension_f = Helper::get_extension($front);
        $front = Helper::get_image($front);

        $extension_b = Helper::get_extension($back);
        $back = Helper::get_image($back);


        // File Name
        $front_name = 'front.'.$extension_f;
        $back_name = 'back.'.$extension_b;
        // Upload Directory
        $upload_dir = 'uploads/orders/' . $order_id.'/';
        $front_url = $upload_dir.$front_name;
        $back_url = $upload_dir.$back_name;
        // Return $upload_dir;


        $front_status = Storage::disk('public')->put($front_url, $front,'public');
        $back_status = Storage::disk('public')->put($back_url, $back,'public');




        //Resize Image
        $resize_image_front_dir = $upload_dir.'resize_front.jpg';
        $resize_image_back_dir = $upload_dir.'resize_back.jpg';
        $resize_image_front = Helper::image_resize($front,200,150);
        $resize_image_back = Helper::image_resize($back,200,150);
        $resize_status_front = Storage::disk('public')->put($resize_image_front_dir, $resize_image_front,'public');
        $resize_status_back = Storage::disk('public')->put($resize_image_back_dir, $resize_image_back,'public');





        $orders = Orders::find($order_id);
        $orders->orderUrl = $upload_dir;
        $orders->save();


        $tmp = 1;
        foreach ($images as $img) {
            $extension_img = Helper::get_extension($img);
            $img = Helper::get_image($img);


            //Upload URL
            $img_upload_dir = $upload_dir.'/img'.$tmp.'.'.$extension_img;
            $img_status = Storage::disk('public')->put($img_upload_dir, $img,'public');
            //file_put_contents($upload_dir . '/img' . $tmp . 'jpg', base64_decode($img));
            $tmp = $tmp + 1;
        }


        $delivery = new DeliveryAddress();
        $delivery->orderID = $order_id;
        $delivery->label = $label;
        $delivery->address = $address;
        $delivery->phone = $phone;
        $delivery->save();
         return "Order no : ".$order_id." Uploaded Successfully";



    }


    public function delivery_charge()
    {
        return "60";
    }


}
