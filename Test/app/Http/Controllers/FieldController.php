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
            ->select('f.accTypeID','a.typeName as accTypeName','a.iconUrl','f.fieldID','f.fieldName','f.iconUrl','f.search_field')
            ->orderBy('f.fieldID', 'asc')
            ->get();
        $account_type = AccountType::all();


        //Checking Field Table is empty or Not
        if($fields->isEmpty())
        {
            $data = array(
                'found'=>false
            );
            return view('admin.field')->with('data',$data);
        }



        $search_field_count = $fields->where('search_field',1)->count();
        $data = array(
            'found'=>true,
            'data' => $fields,
            'account_type' => $account_type,
            'search_field_count' => $search_field_count
        );
        return view('admin.field')->with('data',$data);
    }


    public function create_field(Request $request)
    {
        $field_name = $request->input('field_name');
        $account_type = $request->input('account_type');
        $search_field = $request->input('search_field');





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



        if($account_type == 4)
        {
            $field_1 = new Field;
            $field_1->fieldID = $field_no;
            $field_1->accTypeID = 1;
            $field_1->fieldName = $field_name;
            $field_1->iconUrl = $url;


            $field_2 = new Field;
            $field_2->fieldID = $field_no+1;
            $field_2->accTypeID = 2;
            $field_2->fieldName = $field_name;
            $field_2->iconUrl = $url;
        }else
        {
            $field = new Field;
            $field->fieldID = $field_no;
            $field->accTypeID = $account_type;
            $field->fieldName = $field_name;
            $field->iconUrl = $url;
        }


        $count_search_field = Field::where('search_field',1)->count();
        if($count_search_field > 15 && $search_field)
        {
            if($account_type == 4)
            {
                $field_1->search_field = 0;
                $field_1->save();

                $field_2->search_field = 0;
                $field_2->save();
            }else
            {
                $field->search_field = 0;
                $field->save();
            }
            return redirect('/field')->with('error','16 Icons already Selected for Search Field ..... But New Field Created Successfully');
        }else
        {
            if($account_type == 4)
            {
                $field_1->search_field = $search_field;
                $field_1->save();


                $field_2->search_field = 0;
                $field_2->save();
            }else
            {
                $field->search_field = $search_field;
                $field->save();
            }

        }
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
        $search_field = $request->input('search_field');


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

        $count_search_field = Field::where('search_field',1)->count();
        if($count_search_field > 15 && $search_field)
        {
            $field->search_field = 0;
            $field->save();
            return redirect('/field')->with('error','16 Icons already Selected for Search Field');
        }else
        {
            $field->search_field = $search_field;
            $field->save();
        }

        return redirect('/field')->with('success','Field No : '.$field_id.' Updated Successfully');
    }
}
