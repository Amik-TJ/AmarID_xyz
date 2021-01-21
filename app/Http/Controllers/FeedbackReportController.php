<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackReportController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function view_feedback()
    {
        $feedbacks = DB::table('feedbacks as f')
            ->join('users as by', 'by.userID', '=', 'f.byID')
            ->join('users as for', 'f.forID', '=', 'for.userID')
            ->select('f.feedbackID','f.message','f.time','f.byID','f.forID','by.firstname as byfirstname','by.lastname as bylastname','for.firstname as forfirstname','for.lastname as forlastname' )
            ->orderBy('f.feedbackID', 'asc')
            ->get();


        $data = array(
            'found' => false
        );


        if($feedbacks->isEmpty())
            return view('admin.feedback')->with('data',$data);



        $data = array(
            'found' => true,
            'data' => $feedbacks,
        );
        return view('admin.feedback')->with('data',$data);
    }


    public function view_report()
    {
        $reports = DB::table('report as r')
            ->join('users as by', 'by.userID', '=', 'r.byID')
            ->join('users as for', 'r.forID', '=', 'for.userID')
            ->select('r.reportID','r.message','r.time','r.byID','r.forID','by.firstname as byfirstname','by.lastname as bylastname','for.firstname as forfirstname','for.lastname as forlastname' )
            ->orderBy('r.reportID', 'asc')
            ->get();


        $data = array(
            'found' => false
        );


        if($reports->isEmpty())
            return view('admin.report')->with('data',$data);


        $data = array(
            'found' => true,
            'data' => $reports,
        );


        return view('admin.report')->with('data',$data);
    }
}
