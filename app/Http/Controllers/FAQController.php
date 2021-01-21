<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class FAQController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index(){

        $faqs = FAQ::all();

        //Checking FAQ Table is empty or Not
        if($faqs->isEmpty())
        {
            $data = array(
                'found'=>false
            );
            return view('admin.faq')->with('data',$data);
        }


        $data = array(
            'found'=>true,
            'data' => $faqs,
        );
        return view('admin.faq')->with('data',$data);
    }



    public function edit_faq(Request $request)
    {
        $faq_id = $request->input('faq_id');
        $faq_question = $request->input('question');
        $faq_answer = $request->input('answer');


        // Updating Data
        $faq = FAQ::find($faq_id);
        $faq->faqID = $faq_id;
        $faq->question = $faq_question;
        $faq->answer = $faq_answer;
        $faq->save();

        return redirect('/faq')->with('success','FAQ No : '.$faq_id.' Updated Successfully');
    }


    public function create_FAQ(Request $request)
    {
        $question = $request->input('question');
        $answer = $request->input('answer');



        // Getting number of available Sub Fields in DataBase
        $faq_id = 0;
        $count = DB::table('faq')->count();
        if($count<1)
            $faq_id = 0;
        else
            $faq_id = DB::table('faq')->max('faqID');
        $faq_id++;


        // Checking Null
        if($question == null)
            return redirect('/faq')->with('error','Question is Required');



        $faq = new FAQ();
        $faq->faqID = $faq_id;
        $faq->question = $question;
        if($answer != null)
            $faq->answer = $answer;
        $faq->save();


        return redirect('/faq')->with('success','New FAQ Created Successfully');

    }


    public function delete_faq(Request $request)
    {

        $faq_id = $request->input('faq_id');

        // Deleting Information from Database
        $success = DB::table('faq')->where('faqID',$faq_id)->delete();
        if ($success)
            return redirect('/faq')->with('success','FAQ No : '.$faq_id.' Deleted Successfully');
        else
            return redirect('/faq')->with('error','FAQ No : '.$faq_id.' Cannot be deleted');

    }
}
