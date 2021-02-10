<?php

namespace App\Http\Controllers\Common_Controllers;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    public function index()
    {

        $messages = DB::table('message as m')
            ->where(
                [
                    ['m.senderID','=',auth()->user()->userID]
                ]
            )
            ->orWhere([
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


        return view('common_views.message')->with('data', $messages_data);
    }


    public function show_full_conversation(Request $request)
    {

        $other_id = $request->input('other_id');
        // All Messages
        $all_messages = DB::table('message as m')
            ->where(
                [
                    ['m.senderID','=',auth()->user()->userID]
                ]
            )
            ->orWhere([
                ['m.receiverID','=',auth()->user()->userID]
            ])
            ->join('users as r','r.userID','=','m.receiverID')
            ->join('users as s','s.userID','=','m.senderID')
            ->select('m.messageID','m.senderID','m.receiverID','m.message','m.msgPhotoUrl','m.type','m.time','m.seen','r.userID as ruserID','r.firstname as rfirstname','r.lastname as rlastname','r.photo_url as rphoto_url','s.userID as suserID','s.firstname as sfirstname','s.lastname as slastname','s.photo_url as sphoto_url')
            ->orderBy('m.time','desc')
            ->get();



        // Individual Messages
        $conv = DB::table('message as m')
                            ->where(
                                [
                                    ['m.senderID','=',auth()->user()->userID],
                                    ['m.receiverID','=',$other_id]
                                ]
                            )
                            ->orWhere([
                                ['m.receiverID','=',auth()->user()->userID],
                                ['m.senderID','=',$other_id]
                            ])
                            ->join('users as u','u.userID','=','m.senderID')
                            ->orderBy('m.time','asc')
                            ->select('m.messageID','m.senderID','m.receiverID','m.message','m.msgPhotoUrl','m.type','m.time','m.seen','u.userID','u.firstname','u.lastname','u.photo_url')
                            ->get();



        // Make Conversation Seen

        DB::table('message as m')
            ->where('m.receiverID',auth()->user()->userID)
            ->Where('m.senderID',$other_id)
            ->update(['m.seen' => 1]);


        // Partner Info
        $partner = User::find($other_id);





        $arr = array();
        $all_msg = array();

        $arr[] = array('s' => 0, 'r'=>0);
        foreach ($all_messages as $msg)
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



        $data = array(
            'partner' => $partner,
            'data' => $all_msg,
            'conv' => $conv
        );


        return view('common_views.show_full_conversation')->with('data',$data);


    }


    public function send_message(Request $request)
    {


        $sender_id = $request->input('sender_id');
        $receiver_id = $request->input('receiver_id');
        $msg_txt = $request->input('msg_txt');

        $message = new Message();
        $message->senderID = $sender_id;
        $message->receiverID = $receiver_id;
        $message->message = $msg_txt;
        $message->time = now();
        $message->save();



        $other_id = $receiver_id;


        return view('common_views.send_other_id')->with('data',$other_id);
    }


    public  function search_people(Request $request)
    {
        $name = $request->input('name');

        $name = explode(" ",$name);

        if(count($name) > 1)
        {
            $first_name = $name[0];
            $last_name = $name[1];
        }else{
            $first_name = $name[0];
            $last_name = $name[0];
        }



        $search_result = User::where('firstname', 'LIKE', '%'.$first_name.'%')
                            ->orWhere('lastname','LIKE','%'.$last_name.'%')
                            ->get();


        if($search_result->isEmpty())
            return redirect('/see_more_message')->with('error','No Results Found');
        else
            return view('common_views.search_people')->with('data',$search_result);
    }

}
