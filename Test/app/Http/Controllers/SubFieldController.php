<?php

namespace App\Http\Controllers;

use App\Http\Middleware\TrustHosts;
use App\Imports\SubFieldImport;
use App\Models\Field;
use App\Models\SubField;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Excel;
use phpDocumentor\Reflection\Types\Array_;

class SubFieldController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index(){

        $sub_fields = SubField::all();
        $fields = Field::all();

        //Checking Sub Field Table is empty or Not
        if($sub_fields->isEmpty())
        {
            $data = array(
                'found'=>false,
                'field' => $fields
            );
            return view('admin.sub_field')->with('data',$data);
        }


        $data = array(
            'found'=>true,
            'data' => $sub_fields,
            'field' => $fields
        );
        return view('admin.sub_field')->with('data',$data);
    }


    public function create_sub_field(Request $request)
    {
        $sub_field_name = $request->input('sub_field_name');
        $field_id = $request->input('field_id');
        $translation = null;
        if ($request->filled('translation'))
            $translation = $request->input('translation');


        // Getting number of available Sub Fields in DataBase
        $count = DB::table('sub_field')->count();
        if($count<1)
            $sub_field_no = 0;
        else
            $sub_field_no = DB::table('sub_field')->max('subFieldID');
        $sub_field_no++;


        // Checking Null
        if($sub_field_name == null || $field_id == null)
            return redirect('/sub_field')->with('error','Some Fields are is Missing');


        // Inserting Data Into Sub Field Table
        $sub_field = new SubField;
        $sub_field->fieldID = $field_id;
        $sub_field->subFieldName = $sub_field_name;
        $sub_field->translation = $translation;
        $sub_field->save();


        return redirect('/sub_field')->with('success','New Sub Field Created Successfully');

    }

    public function edit_sub_field(Request $request)
    {

        $sub_field_id = $request->input('sub_field_id');
        $sub_field_name = $request->input('sub_field_name');
        $field_id = $request->input('field_id');
        $translation = $request->input('translation');

        $sub_field = SubField::find($sub_field_id);
        $sub_field->fieldID  = $field_id;
        $sub_field->subFieldName  = $sub_field_name;
        $sub_field->translation  = $translation;
        $sub_field->save();
        return redirect('/sub_field')->with('success','Sub Field No : '.$sub_field_id.' Updated Successfully');
    }



    public function delete_sub_field(Request $request)
    {
        $sub_field_id = $request->input('subFieldID');


        // Deleting Information from Database
        $success = DB::table('sub_field')->where('subFieldID',$sub_field_id)->delete();
        if ($success)
            return redirect('/sub_field')->with('success','Sub Field no: '.$sub_field_id.' deleted Successfully');
        else
            return redirect('/sub_field')->with('error','Sub Field no: '.$sub_field_id.' Cannot be deleted');

    }


    public function upload_sub_field_csv(Request $request)
    {
        $request->validate([
            'sub_field_csv' => 'required|mimes:csv,txt,xls,xlsx'
        ]);



        Excel::import(new SubFieldImport(), $request->sub_field_csv);

        return redirect('/sub_field')->with('success','Data Inserted Successfully');
    }


    public function test()
    {
        /*Field::where('accTypeID',4)->update(array('accTypeID' => 1));
        $field = Field::all();
        $count = $field->count();
        $field_array = array();
        foreach ($field as $f)
        {
            $field_array[] = $f->fieldName;
        }


        foreach ($field_array as $f)
        {
            $field = new Field();
            $field->fieldID = ++$count;
            $field->accTypeID = 2;
            $field->fieldName = $f;
            $field->save();
        }*/


        $date = new DateTime("next year");

    }
}
