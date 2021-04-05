<?php

namespace App\Http\Controllers\Common_Controllers;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notification = Helper::get_user_notifications(auth()->user()->userID);


        if(auth()->user()->admin)
        {
            Notifications::where('userID',auth()->user()->userID)
                ->orWhere('userID',-1)
                ->update(['seen' => 1]);
        }else
        {
            Notifications::where('userID',auth()->user()->userID)
                ->update(['seen' => 1]);
        }

        return view('common_views.notification')->with('data',$notification);
    }
}
