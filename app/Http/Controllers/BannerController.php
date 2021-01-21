<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
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
        $banners = DB::table('banners')->orderBy('bannerID')->get();


        if($banners->isEmpty())
        {
            $data = array(
                'found' => false
            );
            return view('admin.banner')->with('data',$data);
        }


        $data = array(
            'found' => true,
            'data' => $banners
        );
        return view('admin.banner')->with('data',$data);
    }




    public function delete_banner(Request $request)
    {
        $banner_id = $request->input('bannerID');
        $banner_url = Banner::find($banner_id);
        $banner_url = $banner_url->imgURL;


        $response = unlink(storage_path('app/public/'.$banner_url));


        if(!$response)
            return redirect('/banner')->with('error','Banner Cannot Deleted Successfully');


        // Deleting Information from Database
        DB::table('banners')->where('bannerID',$banner_id)->delete();
        return redirect('/banner')->with('success','Banner no : '.$banner_id.' Deleted Successfully');
    }



    public function create_banner(Request $request)
    {
        // Getting number of available Sub Fields in DataBase
        $count = DB::table('banners')->count();
        if($count<1)
            $banner_no = 0;
        else
            $banner_no = DB::table('banners')->max('bannerID');
        $banner_no++;


        // image Storing Tasks
        if ($request->hasFile('banner_image')) {

            if ($request->file('banner_image')->isValid()) {


                $validated = $request->validate([
                    'banner_image' => 'mimes:jpeg,png,jpg|max:5120',
                ]);
                $extension = $request->banner_image->extension();
                $banner_image = 'banner '.$banner_no.'.'.$extension;


                $url = 'uploads/banners/';

                $path = $request->banner_image->storePubliclyAs($url, $banner_image,'public');



                // Db Storing URL
                $url1 = $url.$banner_image;



                $banner = new Banner();
                $banner->bannerID = $banner_no;
                $banner->imgURL = $url1;
                $banner->save();

                return redirect('/banner')->with('success','New Banner Created Successfully');
            }
        }
        abort(500, 'Could not upload image :(');
    }
}
