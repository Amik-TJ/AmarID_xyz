<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class Helper
{
    public static function get_extension(string $string)
    {
        $extension = explode('/', explode(':', substr($string, 0, strpos($string, ';')))[1])[1];   // .jpg .png .pdf
        //return $extension;
        return 'jpg';
    }


    public static function get_image(string $string)
    {

        $replace = substr($string, 0, strpos($string, ',')+1);
        $string = str_replace($replace, '', $string);
        $string = str_replace(' ', '+', $string);
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
        // Getting user Messages
        $messages = DB::table('message as m')
            ->join('users as s', 's.userID', '=', 'm.senderID')
            ->join('users as r', 'r.userID', '=', 'm.receiverID')
            ->where('m.receiverID',$user_id)
            ->select('m.messageID','m.message','m.senderID','m.receiverID','m.msgPhotoUrl','m.type','m.seen','m.time','s.firstname as sfastname','s.lastname as slastname','s.photo_url as sphoto_url','r.firstname as rfirstname','r.lastname as rlastname','r.photo_url as rphoto_url' )
            ->orderBy('m.time', 'desc')
            ->orderBy('m.seen', 'asc')

            ->get();

        if($messages->isEmpty())
            $m_found = false;
        else
            $m_found = true;
        $seen_count = $messages->where('seen',0)->count();

        $messages_data = array(
            'm_found' => $m_found,
            'seen_count' => $seen_count,
            'messages' => $messages,
        );

        return $messages_data;
    }



    public static function get_user_notifications($user_id)
    {
        $notifications = DB::table('notifications')
            ->where('userID',$user_id)
            ->orderBy('seen', 'desc')
            ->orderBy('time', 'desc')
            ->get();


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
}
