<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AccountTypeController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index(){

        $account_type = AccountType::all();


        //Checking Account Type Table is empty or Not
        if($account_type->isEmpty())
        {
            $data = array(
                'found'=>false
            );
            return view('admin.account_type')->with('data',$data);
        }


        $data = array(
            'found'=>true,
            'data' => $account_type
        );
        return view('admin.account_type')->with('data',$data);
    }


    public function create_account_type(Request $request)
    {
        $account_type_name = $request->input('account_type_name');


        // Getting number of available Sub Fields in DataBase
        $count = DB::table('account_type')->count();

        if($count<1)
            $account_type_no = 0;
        else
            $account_type_no = DB::table('account_type')->max('accTypeID');
        $account_type_no++;


        // Checking Null
        if($account_type_name == null)
            return redirect('/account_type')->with('error','Some Fields are Missing');


        $url = null;
        // Inserting Icon Image
        if ($request->hasFile('account_type_icon')) {
            if ($request->file('account_type_icon')->isValid()) {
                $validated = $request->validate([
                    'account_type_icon' => 'mimes:jpeg,png,jpg|max:5120'
                ]);


                $extension = $request->account_type_icon->extension();
                $icon = 'icon.'.$extension;


                $url = 'uploads/account_types/'.$account_type_no.'/';
                $request->account_type_icon->storeAs($url, $icon ,'public');


                // Final Url to Store in DB
                $url = $url.$icon;
            }
        }


        $account_type = new AccountType;
        $account_type->accTypeID = $account_type_no;
        $account_type->typeName = $account_type_name;
        $account_type->iconUrl = $url;
        $account_type->save();


        return redirect('/account_type')->with('success','New Account Type Created Successfully');

    }


    public function edit_account_type(Request $request)
    {


        $account_type_id = $request->input('account_type_id');
        $account_type_name = $request->input('account_type_name');



        // Updating Data
        $account = AccountType::find($account_type_id);
        $account->accTypeID = $account_type_id;
        $account->typeName = $account_type_name;



        if ($request->hasFile('account_type_icon')) {
            if ($request->file('account_type_icon')->isValid()) {
                $validated = $request->validate([
                    'account_type_icon' => 'mimes:jpeg,png,jpg|max:5120'
                ]);


                $extension = $request->account_type_icon->extension();
                $icon = 'icon.'.$extension;


                $url = 'uploads/account_types/'.$account_type_id.'/';
                $request->account_type_icon->storeAs($url, $icon ,'public');


                // Final Url to Store in DB
                $url = $url.$icon;
                $account->iconUrl = $url;

            }
        }
        $account->save();
        return redirect('/account_type')->with('success','Field No : '.$account_type_id.' Updated Successfully');
    }

    public function delete_account_type(Request $request)
    {
        $account_type_id = $request->input('accTypeID');

        // Deleting File With Icon From Storage
        $directory = 'uploads/account_types/'.$account_type_id;
        $response = File::deleteDirectory(public_path($directory));


        // Deleting Information from Database
        $success = DB::table('account_type')->where('accTypeID',$account_type_id)->delete();
        if ($success)
            return redirect('/account_type')->with('success','Account Type No : '.$account_type_id.' Deleted Successfully');
        else
            return redirect('/account_type')->with('error','Account Type : '.$account_type_id.' Cannot be deleted');

    }
}
