<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Filesystem\Filesystem;

class TemplateController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $templates = DB::table('templates')->get();
        return view('admin.template')->with('templates',$templates);
    }




    public function delete_template(Request $request)
    {
        $template_id = $request->input('templateID');

        // Deleting File With Images From Storage
        $directory = 'uploads/templates/'.$template_id;
        $response = File::deleteDirectory(storage_path('app/public/'.$directory));

        if(!$response)
            return redirect('/template')->with('error','Template Cannot Deleted Successfully');


        // Deleting Information from Database
        DB::table('templates')->where('templateID',$template_id)->delete();
        return redirect('/template')->with('success','Template Deleted Successfully');
    }



    public function create_template(Request $request)
    {
        // Getting number of available templates in DataBase
        $count = DB::table('templates')->count();
        if($count<1)
            $template_no = 0;
        else
            $template_no = DB::table('templates')->max('templateID');
        $template_no++;


        // image Storing Tasks
        if ($request->hasFile('front_image') && $request->hasFile('back_image')) {

            if ($request->file('front_image')->isValid() && $request->file('back_image')->isValid()) {


                $validated = $request->validate([
                    'front_image' => 'mimes:jpeg,png,jpg|max:5120',
                    'back_image' => 'mimes:jpeg,png,jpg|max:5120',
                ]);
                $extension1 = $request->front_image->extension();
                $extension2 = $request->back_image->extension();
                $front = 'front.'.$extension1;
                $back = 'back.'.$extension2;

                $url = 'uploads/templates/'.$template_no.'/';
                $request->front_image->storeAs($url, $front ,'public');
                $request->back_image->storeAs($url, $back,'public');



                $url1 = $url.$front;
                $url2 = $url.$back;



                $package_weight1 = $request->input('weight1');
                $package_weight2 = $request->input('weight2');
                $package_weight3 = $request->input('weight3');

                if( $package_weight1 == null && $package_weight2 == null && $package_weight3 == null)
                    $package_weight = "Null";
                elseif($package_weight1 == null && $package_weight2 == null && $package_weight3 != null)
                    $package_weight = $package_weight3 ;
                elseif($package_weight1 == null && $package_weight2 != null && $package_weight3 == null)
                    $package_weight = $package_weight2 ;
                elseif($package_weight1 == null && $package_weight2 != null && $package_weight3 != null)
                    $package_weight = $package_weight2.','.$package_weight3;
                elseif($package_weight1 != null && $package_weight2 == null && $package_weight3 == null)
                    $package_weight = $package_weight1 ;
                elseif($package_weight1 != null && $package_weight2 == null && $package_weight3 != null)
                    $package_weight = $package_weight1.','.$package_weight3;
                elseif($package_weight1 != null && $package_weight2 != null && $package_weight3 == null)
                    $package_weight = $package_weight1.','.$package_weight2;
                else
                    $package_weight = $package_weight1.','.$package_weight2.','.$package_weight3 ;


                $template = new Template();
                $template->templateID = $template_no;
                $template->frontUrl = $url1;
                $template->backUrl = $url2;
                $template->weight = $package_weight;
                $template->save();
                return redirect('/template')->with('success','New Template Created Successfully');
            }
        }
        abort(500, 'Could not upload image :(');
    }
}
