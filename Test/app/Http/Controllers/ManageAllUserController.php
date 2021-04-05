<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageAllUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = DB::table('users as v')
        ->where(
            [
                ['v.admin',0],
                ['v.print_vendor',0],
                ['v.delivery_vendor',0],
            ]
        )
            ->join('account_type as a','v.accTypeID','=','a.accTypeID')
            ->join('field as f','v.fieldID','=','f.fieldID')
            ->join('sub_field as s','v.subFieldID','=','s.subFieldID')
            ->select('v.userID','v.firstname','v.lastname','v.location','v.email','v.phone','v.photo_url','a.typeName as acc_type','v.accTypeID','v.fieldID','f.fieldName as field_type','v.subFieldID','s.subFieldName as sub_type')
            ->get();

        $total_user = $user->count();


        $data = array(
            'found' => false,
        );


        if($user->isEmpty())
        {
            return view('admin.view_all_users')->with('data',$data);
        }else{
            $data = array(
                'found' => true,
                'user_count' => $total_user,
                'data' => $user,
            );

            return view('admin.view_all_users')->with('data',$data);
        }
    }
}
