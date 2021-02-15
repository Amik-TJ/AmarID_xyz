<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DeliveryAddress;
use App\Models\Orders;
use App\Models\Predesigned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Flysystem\File;
use mysqli;
use App\Models\Notifications;
use App\Models\User;
use Throwable;
class RemoteRequestController extends Controller
{

    public function upload_design(Request $request)
    {

        // ----------------   Previous API Starts ----------------------------- //

        $front = base64_decode($_POST['front']);
        $back = base64_decode($_POST['back']);
        $json = $_POST['json'];
        $name = $_POST['name'];



        $upload_dir = 'uploads/designs/'.$name;
        /*if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }*/

        Storage::disk('public')->put($upload_dir.'/front.jpg', $front,'public');
        Storage::disk('public')->put($upload_dir.'/back.jpg', $back,'public');


        //file_put_contents($upload_dir.'/front.jpg', $front);
        //file_put_contents($upload_dir.'/back.jpg', $back);


        $fu = $upload_dir . "/front.jpg";
        $bu = $upload_dir . "/back.jpg";

        $predesigned = new Predesigned();
        $predesigned->json = $json;
        $predesigned->frontUrl = $fu;
        $predesigned->backUrl = $bu;
        $predesigned->save();
        return "Uploaded Successfully. ";






        // ----------------- Laravel Part Starts --------------------- //
        /*$front = $request->input('front');
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
            return "Image cannot be uploaded";*/

    }


    public function upload_image(Request $request)
    {
        // Connection Credentials
        /*if(DB::connection()->getDatabaseName())
        {
            echo "conncted sucessfully to database ".DB::connection()->getDatabaseName(). "<br/>\r\n";
            echo "Driver: " . Config::get('database.connections.mysql.driver') . "<br/>\r\n";
            echo "Host: " . Config::get('database.connections.mysql.host') . "<br/>\r\n";
            echo "Database: " . Config::get('database.connections.mysql.database') . "<br/>\r\n";
            echo "Username: " . Config::get('database.connections.mysql.username') . "<br/>\r\n";
            echo "Password: " . Config::get('database.connections.mysql.password') . "<br/>\r\n";
            return;
        }*/



        // Previous PHP API Starts ----------------//
        $root = $_SERVER["DOCUMENT_ROOT"];



        $image = $_POST['image'];
        $name = $_POST['name'];
        $message_photo = $_POST['message_photo'];
        $realImage = base64_decode($image);
//	echo $message_photo."<br/>";
        /*if ($message_photo == "1"){
            $upload_dir = $root.'public/uploads/messages/';
            //echo $upload_dir."<br/>";
            if (!is_dir($upload_dir)) {
                // dir doesn't exist, make it
                mkdir($upload_dir, 0777, true);
            }
        }
        else{
            $upload_dir = $root.'public/uploads/photos/';
            //echo $upload_dir."<br/>";
            if (!is_dir($upload_dir)) {
                // dir doesn't exist, make it
                mkdir($upload_dir, 0777, true);
            }
        }

        file_put_contents($upload_dir.$name, $realImage);
        echo "Image Uploaded Successfully.";*/


        //return gettype($image);
        if ($message_photo == "1"){
            $upload_dir = '/uploads/messages/'.$name;
        }
        else{
            $upload_dir = '/uploads/photos/'.$name;
        }


        $status = Storage::disk('public')->put($upload_dir, $realImage,'public');
        if($status)
            return "Image Uploaded Successfully. ";
        else
            return "Image cannot be uploaded";




        // ------------------- Laravel API Starts  ------------------------- //

/*
        $image = $request->input('image');
        $name = $request->input('name');
        $message_photo = $request->input('message_photo');




        //your base64 encoded data

        $extension = Helper::get_extension($image);
        $image = Helper::get_image($image);
        $name = $name.'.'.$extension;

        //return gettype($image);
        if ($message_photo == "1"){
            $upload_dir = '/uploads/messages/'.$name;
        }
        else{
            $upload_dir = '/uploads/photos/'.$name;
        }


        $status = Storage::disk('public')->put($upload_dir, $image,'public');
        if($status)
            return "Image Uploaded Successfully. ";
        else
            return "Image cannot be uploaded";*/

    }


    public function place_order(Request $request)
    {
        // --------------- Previous PHP API Starts -------------------- //

/*
        $front = base64_decode($_POST['front']);
        $back = base64_decode($_POST['back']);
        $userID = (int)($_POST['user_id']);
        $packageID = (int)($_POST['package_id']);
        $glossy = (int)($_POST['glossy']);
        $spot = (int)($_POST['spot']);
        $rounded = (int)($_POST['rounded']);
        $total_price = (double)($_POST['total_price']);
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $label = $_POST['label'];
        $json_txt = $_POST['json'];

        $images = json_decode($_POST['images']);

*/


        $front = base64_decode($request->input('front'));
        $back = base64_decode($request->input('back'));
        $userID = (int)($request->input('user_id'));
        $packageID = (int)($request->input('package_id'));
        $glossy = (int)($request->input('glossy'));
        $spot = (int)($request->input('spot'));
        $rounded = (int)($request->input('rounded'));
        $total_price = (double)($request->input('total_price'));
        $phone = $request->input('phone');
        $address = $request->input('address');
        $label = $request->input('label');
        $json_txt = $request->input('json');
        $images = json_decode($request->input('images'));





        try {
            $orders = new Orders();
            $orders->userID = $userID;
            $orders->packageID = $packageID;
            $orders->glossy = $glossy;
            $orders->spot = $spot;
            $orders->rounded = $rounded;
            $orders->total_price = $total_price;
            $orders->json = $json_txt;
            $orders->save();
            $orderID =  $orders->orderID;

            $upload_dir = 'uploads/orders/' . $orderID;


            $ordr = Orders::find($orderID);
            $ordr->orderUrl = $upload_dir;
            $ordr->save();

        }
        catch (Throwable $e) {
            report($e);
            echo 'Message: ' .$e->getMessage();;
        }



        //mkdir(storage_path().'/app/public/'.$upload_dir, 0777, true);
        /*if (!file_exists(storage_path().'/app/public/'.$upload_dir)) {
            mkdir(storage_path().'/app/public/'.$upload_dir, 0777, true);
        }*/



        try {
            mkdir(storage_path().'/app/public/'.$upload_dir, 0777, true);
            Storage::disk('public')->put($upload_dir . '/front.jpg', $front,'public');
            Storage::disk('public')->put($upload_dir . '/back.jpg', $back,'public');
        }
        catch (Throwable $e) {
            report($e);
            echo 'Message: ' .$e->getMessage();;
        }


//
        $tmp = 1;
        foreach ($images as &$img) {
            try {
                $img_upload_dir = $upload_dir . '/img' . $tmp . '.jpg';
                $path = Storage::disk('public')->put($img_upload_dir, base64_decode($img), 'public');
                $tmp = $tmp + 1;
            }catch (Throwable $e) {
                report($e);
                echo 'Message: ' .$e->getMessage();;
            }
        }



        $delivery = new DeliveryAddress();
        $delivery->orderID = $orderID;
        $delivery->label = $label;
        $delivery->address = $address;
        $delivery->phone = $phone;
        $delivery->save();



        // Inserting Data in Notification Table
        $notification_message = "Your Order has been Placed";
        $notification = new Notifications();
        $notification->userID = $userID;
        $notification->message = $notification_message;
        $notification->type = 4.1; // Type 4.1 for Order Placed
        $notification->time = now();
        $notification->seen = 0;
        $notification->save();

        $device_id = User::where('userID',$userID)->select('deviceID')->first();

        // Sending Push Notification
        if($device_id != null)
        {
            $push = new PushNotificationController();
            $push->push_notification_android($device_id,$notification_message,4.1);
        }


        /*return "{$orderID}";*/
        return strval($orderID);

    }


    public function delivery_charge()
    {
        return "60";
    }


}
