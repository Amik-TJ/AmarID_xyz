<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FieldController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index(){


        $fields = DB::table('field as f')
            ->leftJoin('account_type as a', 'a.accTypeID', '=', 'f.fieldID')
            ->select('f.accTypeID','a.typeName as accTypeName','a.iconUrl','f.fieldID','f.fieldName','f.iconUrl')
            ->orderBy('f.fieldID', 'asc')
            ->get();
        $account_type = AccountType::all();
        /*echo "<pre>";
        print_r($fields);
        echo "</pre>";
        return ;*/

        //Checking Field Table is empty or Not
        if($fields->isEmpty())
        {
            $data = array(
                'found'=>false
            );
            return view('admin.field')->with('data',$data);
        }


        $data = array(
            'found'=>true,
            'data' => $fields,
            'account_type' => $account_type
        );
        return view('admin.field')->with('data',$data);
    }


    public function create_field(Request $request)
    {
        $field_name = $request->input('field_name');
        $account_type = $request->input('account_type');



        // Getting number of available Sub Fields in DataBase
        $count = DB::table('field')->count();
        if($count<1)
            $field_no = 0;
        else
            $field_no = DB::table('field')->max('fieldID');
        $field_no++;


        // Checking Null
        if($field_name == null || $account_type == null)
            return redirect('/field')->with('error','Some Fields are Missing');


        $url = null;
        // Inserting Icon Image
        if ($request->hasFile('field_icon')) {
            if ($request->file('field_icon')->isValid()) {
                $validated = $request->validate([
                    'field_icon' => 'mimes:jpeg,png,jpg|max:5120'
                ]);


                $extension = $request->field_icon->extension();
                $icon = 'icon.'.$extension;


                $url = 'uploads/fields/'.$field_no.'/';
                $request->field_icon->storeAs($url, $icon ,'public');


                // Final Url to Store in DB
                $url = $url.$icon;
            }
        }


        $field = new Field;
        $field->fieldID = $field_no;
        $field->accTypeID = $account_type;
        $field->fieldName = $field_name;
        $field->iconUrl = $url;
        $field->save();


        return redirect('/field')->with('success','New Field Created Successfully');

    }


    public function delete_field(Request $request)
    {
        $field_id = $request->input('fieldID');

        // Deleting File With Icon From Storage
        $directory = 'uploads/fields/'.$field_id;
        $response = File::deleteDirectory(public_path($directory));


        // Deleting Information from Database
        $success = DB::table('field')->where('fieldID',$field_id)->delete();
        if ($success)
            return redirect('/field')->with('success','Field No : '.$field_id.' Deleted Successfully');
        else
            return redirect('/field')->with('error','Field No : '.$field_id.' Cannot be deleted');

    }


    public function edit_field(Request $request)
    {
        $field_id = $request->input('field_id');
        $field_name = $request->input('field_name');
        $account_type_id = $request->input('account_type');


        // Updating Data
        $field = Field::find($field_id);
        $field->accTypeID = $account_type_id;
        $field->fieldName = $field_name;


        if ($request->hasFile('field_icon'))
        {
            if ($request->file('field_icon')->isValid()) {
                $validated = $request->validate([
                    'field_icon' => 'mimes:jpeg,png,jpg|max:5120'
                ]);


                $extension = $request->field_icon->extension();
                $icon = 'icon.'.$extension;


                $url = 'uploads/fields/'.$field_id.'/';
                $request->field_icon->storeAs($url, $icon ,'public');


                // Final Url to Store in DB
                $url = $url.$icon;
                $field->iconUrl = $url;
            }
        }
        $field->save();
        return redirect('/field')->with('success','Field No : '.$field_id.' Updated Successfully');
    }
}
