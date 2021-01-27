<?php

namespace App\Http\Controllers\Common_Controllers;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Helper::get_user_messages(auth()->user()->userID);
        return view('common_views.message')->with('data', $messages);
    }


    public function show_full_conversation(Request $request)
    {


        $messages = Helper::get_user_messages(auth()->user()->userID);
        return view('common_views.show_full_conversation')->with('data',$messages);


    }
}
