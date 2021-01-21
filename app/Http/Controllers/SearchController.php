<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Field;
use App\Models\Sub_Field;
use App\Models\Account_Type;
use App\Models\Users;
use phpDocumentor\Reflection\Types\Null_;
use function PHPUnit\Framework\isNull;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        // Checking the request from icon or form input
        if ($request->input('icon_keyword') == 'false')
            $keyword = strtolower($request->keyword);
        else
            $keyword = strtolower($request->icon_keyword);



        $result = DB::table('account_type')->where('typeName', 'like', '%'.$keyword.'%')->get()->first();
        if($result != null)
        {
            $id = $result->accTypeID;
            $user_info=DB::table('users as u')
                            ->join('account_type as a','a.accTypeID','=','u.accTypeID')
                            ->join('field as f','f.fieldID','=','u.fieldID')
                            ->join('sub_field as s','s.subFieldID','=','u.subFieldID')
                            ->select('u.firstname','u.lastname','u.email','u.phone','u.location','u.photo_url','u.photo_url','a.typeName','f.fieldName','s.subFieldName')
                            ->where('a.accTypeID',$id)->get();


            $data = [
                'modal'  => true,
                'found' => true,
                'data'   => $user_info
            ];
            return view('welcome')->with('data',$data);
        }

        $result = DB::table('field')->where('fieldName', 'like', '%'.$keyword.'%')->get()->first();
        if($result != null)
        {
            $id = $result->fieldID;
            $user_info=DB::table('users as u')
                ->join('account_type as a','a.accTypeID','=','u.accTypeID')
                ->join('field as f','f.fieldID','=','u.fieldID')
                ->join('sub_field as s','s.subFieldID','=','u.subFieldID')
                ->select('u.firstname','u.lastname','u.email','u.phone','u.location','u.photo_url','a.typeName','f.fieldName','s.subFieldName')
                ->where('f.fieldID',$id)->get();


            $data = [
                'modal'  => true,
                'found' => true,
                'data'   => $user_info
            ];
            return view('welcome')->with('data',$data);
        }

        $result = DB::table('sub_field')->where('subFieldName', 'like', '%'.$keyword.'%')->orWhere('translation', 'like', '%'.$keyword.'%')->get()->first();
        if($result != null)
        {
            $id = $result->subFieldID;
            $user_info=DB::table('users as u')
                            ->join('account_type as a','a.accTypeID','=','u.accTypeID')
                            ->join('field as f','f.fieldID','=','u.fieldID')
                            ->join('sub_field as s','s.subFieldID','=','u.subFieldID')
                            ->select('u.firstname','u.lastname','u.email','u.phone','u.location','u.photo_url','a.typeName','f.fieldName','s.subFieldName')
                            ->where('s.subFieldID',$id)->get();


            $data = [
                'modal'  => true,
                'found' => true,
                'data'   => $user_info
            ];
            return view('welcome')->with('data',$data);
        }
        $data = [
            'modal' => true,
            'found'  => false,
        ];

        return view('welcome')->with('data',$data);

    }
}

