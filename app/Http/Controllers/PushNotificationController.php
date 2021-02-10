<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    function push_notification_android($device_id, $message, $notification_code)
    {

        //API URL of FCM
        $url = 'https://fcm.googleapis.com/fcm/send';

        /*api_key available in:
        Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/
        $api_key = 'AAAAJ4gTlVQ:APA91bFSZE_GJyrQ7kNdP6dOdjUsHW_e0CIqBZ88vaTkQY42fMBVfOwqdO4c83Ifn8arxfs5FiWHpQbnz6vAtCZAG7HAheMfAbd68-7RJGULJDiukLQ6mkZ-OajaylU0_h8-LiQ2SPDU';

        $fields = array(
            'to' => $device_id,
            'priority' => 'high',
            'notification' => array(
                'body' => $message,
                'title' => 'New notification'
            ),
            'data' => array(
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                'status' => 'done',
                'code' => $notification_code
            )
        );
        //header includes Content type and api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $api_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return json_decode($result, true);
    }
}
