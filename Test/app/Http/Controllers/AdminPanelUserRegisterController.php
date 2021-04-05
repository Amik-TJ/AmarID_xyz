<?php

namespace App\Http\Controllers;

use App\Imports\VerifyUserImport;
use App\Models\Verify_User;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
//use Maatwebsite\Excel\Excel;
use Excel;

class AdminPanelUserRegisterController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.admin_user_registration');
    }


    public function register_user(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email|unique:verify_user,email',
            'password' => 'required|string|min:4|confirmed',
            'phone' => 'required|numeric|min:11|unique:users|unique:verify_user,phone',
            'sub_field' => 'required|string|max:255',
            'location' => 'required|string|max:255'
        ]);

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $password = $request->input('password');
        $phone = $request->input('phone');
        $sub_field_id = $request->input('sub_field');
        $location = $request->input('location');



        $field_id = DB::table('sub_field')->where('subFieldID', $sub_field_id)->value('fieldID');
        $account_type_id = DB::table('field')->where('fieldID', $field_id)->value('accTypeID');


        $verify = new Verify_User();
        $verify->firstname = $first_name;
        $verify->lastname = $last_name;
        $verify->email = $email;
        $verify->phone = $phone;
        $verify->password = $password;
        $verify->accTypeID = $account_type_id;
        $verify->fieldID = $field_id;
        $verify->subFieldID = $sub_field_id;
        $verify->location = $location;
        $verify->admin = 0;
        $verify->print_vendor = 0;
        $verify->delivery_vendor = 0;
        $verify->active = 0;
        $verify->save();

        $new_user_id = $verify->userID;

        return redirect('/admin_user_registration')->with('success','New User Created Successfullt and Temporary User ID is : '.$new_user_id);

    }



    public function view_unverified_user()
    {
        $unverified_users = DB::table('verify_user as v')
                                ->join('account_type as a','v.accTypeID','=','a.accTypeID')
                                ->join('field as f','v.fieldID','=','f.fieldID')
                                ->join('sub_field as s','v.subFieldID','=','s.subFieldID')
                                ->select('v.userID','v.firstname','v.lastname','v.location','v.email','v.phone','v.photo_url','a.typeName as acc_type','v.accTypeID','v.fieldID','f.fieldName as field_type','v.subFieldID','s.subFieldName as sub_type')
                                ->get();


        $data = array(
            'found' => false,
        );
        if($unverified_users->isEmpty())
            return view('admin.verify_user_registration')->with('data',$data);


        $data = array(
            'found' => true,
            'data' => $unverified_users,
        );
        return view('admin.verify_user_registration')->with('data',$data);
    }

    public function verify_user_registration(Request $request)
    {
        $unverified_user_id = $request->input('user_id');

        $unverified = Verify_User::find($unverified_user_id);


        $user = new User();
        $user->firstname = $unverified->firstname;
        $user->lastname = $unverified->lastname;
        $user->email = $unverified->email;
        $user->phone = $unverified->phone;
        $user->password = $unverified->password;
        $user->photo_url = $unverified->photo_url;
        $user->accTypeID = $unverified->accTypeID;
        $user->subFieldID = $unverified->subFieldID;
        $user->fieldID = $unverified->fieldID;
        $user->location = $unverified->location;
        $user->admin = 0;
        $user->print_vendor = 0;
        $user->delivery_vendor = 0;
        $user->active = 0;
        $status_1 = $user->save();


        // New User ID
        $new_user_id = $user->userID;


        // Deleting Row from verify_user table
        $status_2 = $unverified->delete();

        if($status_1 && $status_2)
            return redirect('/view_unverified_user')->with('success','Temporary User ID : '.$unverified_user_id.' has been verified and new User ID is : '.$new_user_id);
        else
            return redirect('/view_unverified_user')->with('error','Temporary User ID : '.$unverified_user_id.' cannot be verified successfully');
    }



    public function vendor_registration()
    {
        return view('admin.admin_vendor_registration');
    }


    public function register_vendor(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email|unique:verify_user,email',
            'password' => 'required|string|min:4|confirmed',
            'phone' => 'required|numeric|min:11|unique:users|unique:verify_user,phone',
            'vendor_type' => 'required|string|max:255',
            'location' => 'required|string|max:255'
        ]);

        $vendor_type = $request->input('vendor_type');
        if($vendor_type == 1)
        {
            $print_vendor = 1;
            $delivery_vendor = 0;
            $string = 'Print Vendor';
        }elseif ($vendor_type == 2)
        {
            $print_vendor = 0;
            $delivery_vendor = 1;
            $string = 'Delivery Vendor';
        }

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $password = $request->input('password');
        $phone = $request->input('phone');
        $location = $request->input('location');
        $sub_field_id = $request->input('sub_field');


        $admin = 0;
        $field_id = DB::table('sub_field')->where('subFieldID', $sub_field_id)->value('fieldID');
        $account_type_id = DB::table('field')->where('fieldID', $field_id)->value('accTypeID');




        $user = new User();
        $user->firstname = $first_name;
        $user->lastname = $last_name;
        $user->email = $email;
        $user->phone = $phone;
        $user->password = $password;
        $user->photo_url = null;
        $user->accTypeID = $account_type_id;
        $user->subFieldID = $sub_field_id;
        $user->fieldID = $field_id;
        $user->location = $location;
        $user->admin = $admin;
        $user->print_vendor = $print_vendor;
        $user->delivery_vendor = $delivery_vendor;
        $user->active = 1;
        $user->save();
        $new_user_id = $user->userID;

        return redirect('/admin_vendor_registration')->with('success','Name : '.$first_name.' '.$last_name.' registered as new '.$string.' || User ID : '.$new_user_id);

    }

    public STATIC  $static_account_type;

    // Register Using CSV
    public function register_user_csv(Request $request)
    {

        $request->validate([
            'csv_file' => 'required|mimes:csv,txt,xls,xlsx'
        ]);

        self::$static_account_type = $request->input('account_type');


        Excel::import(new VerifyUserImport, $request->csv_file);

        return redirect('/admin_user_registration')->with('success','Data Inserted Successfully');
    }




}
