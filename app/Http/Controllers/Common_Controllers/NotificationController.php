<?php

namespace App\Http\Controllers\Common_Controllers;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notification = Helper::get_user_notifications(auth()->user()->userID);
        return view('common_views.notification')->with('data',$notification);
    }
}
