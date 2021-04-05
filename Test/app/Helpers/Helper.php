<?php
namespace App\Helpers;

use App\Http\Controllers\PushNotificationController;
use App\Models\Notifications;
use App\Models\Orders;
use App\Models\Payments;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Throwable;

class Helper
{
    public static function get_extension(string $string)
    {
        //$extension = explode('/', explode(':', substr($string, 0, strpos($string, ';')))[1])[1];   // .jpg .png .pdf
        //return $extension;
        return 'jpg';
    }


    public static function get_image(string $string)
    {

        $replace = substr($string, 0, strpos($string, ',')+1);
        //$string = str_replace($replace, '', $string);
        //$string = str_replace(' ', '+', $string);
        $string = base64_decode($string);
        return $string;
    }



    public static function  image_resize($file, $w, $h, $crop=FALSE) {
        //list($width, $height) = getimagesize($file);
        $src = imagecreatefromstring($file);
        if (!$src) return false;
        $width = imagesx($src);
        $height = imagesy($src);

        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        //$src = imagecreatefrompng($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        // Buffering
        ob_start();
        imagepng($dst);
        $data = ob_get_contents();
        ob_end_clean();
        return $data;
    }


    public static function get_user_messages($user_id)
    {


        $messages = DB::table('message as m')
            ->Where([
                ['m.receiverID','=',auth()->user()->userID]
            ])
            ->join('users as r','r.userID','=','m.receiverID')
            ->join('users as s','s.userID','=','m.senderID')
            ->select('m.messageID','m.senderID','m.receiverID','m.message','m.msgPhotoUrl','m.type','m.time','m.seen','r.userID as ruserID','r.firstname as rfirstname','r.lastname as rlastname','r.photo_url as rphoto_url','s.userID as suserID','s.firstname as sfirstname','s.lastname as slastname','s.photo_url as sphoto_url')
            ->orderBy('m.time','desc')
            ->get();


        if($messages->isEmpty())
            $m_found = false;
        else
            $m_found = true;
        $seen_count = $messages->where('seen',0)
            ->where('senderID','!=',auth()->user()->userID)
            ->count();



        // Getting Unique Messages

        $arr = array();
        $all_msg = array();

        $arr[] = array('s' => 0, 'r'=>0);
        foreach ($messages as $msg)
        {
            $duplicate = Helper::conversation_id_search($arr,$msg->senderID,$msg->receiverID);
            if($duplicate)
                continue;
            else
            {
                $all_msg[] = $msg;
            }
            $arr[] = array('s' => $msg->senderID, 'r'=>$msg->receiverID);
        }



        $messages_data = array(
            'm_found' => $m_found,
            'seen_count' => $seen_count,
            'messages' => $all_msg,
        );

        return $messages_data;
    }



    public static function get_user_notifications($user_id)
    {

        if(auth()->user()->admin)
        {
            $notifications = DB::table('notifications')
                ->where('userID',$user_id)
                ->orWhere('userID',-1)
                ->orderBy('time', 'desc')
                ->get();
        }else
        {
            $notifications = DB::table('notifications')
                ->where('userID',$user_id)
                ->orderBy('time', 'desc')
                ->get();
        }



        if($notifications->isEmpty())
            $n_found = false;
        else
            $n_found = true;
        $seen_count = $notifications->where('seen',0)->count();

        $notification_data = array(
            'n_found' => $n_found,
            'seen_count' => $seen_count,
            'notifications' => $notifications,
        );

        return $notification_data;
    }


    public static function dashboard_selector()
    {
        if (!Auth::check()) {
            return '/login';
        }

        if (auth()->user()->admin == 1) {


            return '/admin_dash_board';
        }

        if (auth()->user()->admin == 0  && auth()->user()->print_vendor == 1) {
            return '/on_print';
        }

        if (auth()->user()->admin == 0  && auth()->user()->delivery_vendor == 1) {
            return  '/shipped_order';
        }
        return  '/user_dashboard';
    }



    public static function conversation_id_search($arr, $sender, $receiver)
    {
        foreach ($arr as $a)
        {
            if($a['s'] == $sender && $a['r'] == $receiver)
            {
                return true;
            }elseif ($a['r'] == $sender && $a['s'] == $receiver)
            {
                return true;
            }
        }
        return false;
    }


    public static function insert_notification($user_id,$message,$type)
    {
        $notification = new Notifications();
        $notification->userID = $user_id;
        $notification->message = $message;
        $notification->type = $type;
        $notification->time = now();
        $notification->seen = 0;
        $notification->save();
    }


    public static function admin_push_notification($admin_message,$type)
    {
        $admin = User::where('admin',1)->get();
        if(!$admin->isEmpty())
        {
            foreach ($admin as $ad)
            {
                if($ad->deviceID != null)
                {
                    $push = new PushNotificationController();
                    $push->push_notification_android($ad->deviceID,$admin_message,$type);
                }
            }
        }
    }


    public static function get_order_url_for_admin($notification_id,$message,$type)
    {
        /*$notification = Notifications::find($notification_id);
        $notification->seen = 1;
        $notification->save();*/


        if($type == 4.1)
        {
            $order = explode(':',$message);
            $order_id = $order[1];

            $order = Orders::where('orderID',$order_id)->first();
            if($order->status == 'On Verification')
                return '/verify_orders';
            else
            {
                return "/placed_order";
            }
        }
        else if($type == 4.2)
        {
            if(auth()->user()->delivery_vendor)
                return "/shipped_order";
            return "/on_print";
        }
        else if($type == 4.3)
        {
            return "/on_print";
        }
        else if($type == 4.4)
        {
            return "/delivered_order";
        }


        return '/show_more_notification';
    }


    public static function get_order_url_for_user($message,$type)
    {
        return "/show_more_notification";
    }


    public static function api_verification($token)
    {
        $key = 'ac/dcthunder500m';
        $iv = "iaminevitable...";
        $cipher = "aes-128-cbc";
        $ciphertext = $token;
        $json = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv);
        $array = json_decode($json);


        // Time Difference
        $current_time = round(time() * 1000);
        $received_time = (int)($array->time_stamp);
        try{
            $dif = $current_time - $received_time;
        }catch (Throwable $e)
        {
            return false;
            //return 'String Format error     : Time Stamp'.$received_time.' .........And type is '.gettype($received_time);
        }
        if($dif>30000)
            return false;
            //return 'Time is greater than 30';


        // User ID and device ID verification
        $user_id = $array->user_id;
        $device_id = $array->device_id;

        try {
            $user = User::find($user_id);
        }catch (Throwable $e)
        {
            return false;
            //return 'User not exists';
        }


        if($device_id != $user->deviceID)
            return false;
            //return "Device ID didn't match";

        return true;
    }
}
