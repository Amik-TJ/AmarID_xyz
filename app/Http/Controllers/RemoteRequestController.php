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

class RemoteRequestController extends Controller
{

    public function upload_design(Request $request)
    {

        // ----------------   Previous API Starts ----------------------------- //

        $front = base64_decode($_POST['front']);
        $back = base64_decode($_POST['back']);
        $json = $_POST['json'];
        $name = $_POST['name'];

        $servername = Config::get('database.connections.mysql.host');
        $username = Config::get('database.connections.mysql.username');
        $password = 'aLNFA0t7m4IW';
        $dbname = Config::get('database.connections.mysql.database');

        $upload_dir = 'uploads/designs/'.$name;
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        file_put_contents($upload_dir.'/front.jpg', $front);
        file_put_contents($upload_dir.'/back.jpg', $back);

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $json = $conn->real_escape_string($json);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //echo "Connected successfully";
        $fu = $upload_dir . "/front.jpg";
        $bu = $upload_dir . "/back.jpg";

        $sql = "INSERT INTO predesigned (json, frontUrl, backUrl) VALUES('" . $json . "','" . $fu . "','" . $bu ."')";
        //echo $sql;
        $conn->query($sql);




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
        if ($message_photo == "1"){
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
        echo "Image Uploaded Successfully.";




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
///
        $images = json_decode($_POST['images']);
//echo $images;
// echo "<br>".gettype($images);

///


        $servername = Config::get('database.connections.mysql.host');
        $username = Config::get('database.connections.mysql.username');
        $password = 'aLNFA0t7m4IW';
        $dbname = Config::get('database.connections.mysql.database');

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
//echo "Connected successfully";

        $sql = "INSERT INTO orders (userID, packageID, glossy, spot, rounded, total_price) VALUES(" . $userID . "," . $packageID . "," . $glossy . "," . $spot . "," . $rounded . "," . $total_price . ")";


        if ($conn->query($sql) === TRUE) {
            $orderID = $conn->insert_id;

            //
            $upload_dir = 'uploads/orders/' . $orderID;
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            file_put_contents($upload_dir . '/front.jpg', $front);
            file_put_contents($upload_dir . '/back.jpg', $back);

//
            //$tmp = 1
            foreach ($images as &$img) {
                file_put_contents($upload_dir . '/img' . $tmp . 'jpg', base64_decode($img));
                $tmp = $tmp + 1;
            }

//
            $sql = "UPDATE orders SET orderUrl = '" . $upload_dir . "' WHERE orderID=" . $orderID;
            $conn->query($sql);
            $sql_delivery = "INSERT INTO delivery_address(orderID, label, address, phone) VALUES (" . $orderID . ",'" . $label . "','" . $address . "','" . $phone . "')";
            $conn->query($sql_delivery);
            echo $orderID;
            //
        } else {
            die("Connection failed: ");
        }






        // ----------------- Laravel API Starts --------------------- //
        /*$front = $request->input('front');
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
*/


    }


    public function delivery_charge()
    {
        return "60";
    }


}
