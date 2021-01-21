<?php

namespace App\Http\Controllers;


use App\Helpers\Helper;
use App\Models\WebAppBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class WebAppBlogController extends Controller
{
    public function index()
    {
        $blog = WebAppBlog::get();
        if($blog->isEmpty())
        {
            $data = array(
                'found' => false,
            );
        }else
        {
            $data = array(
                'found' => true,
                'data' => $blog,
            );

        }

        return view('admin.web_app_blog')->with('data',$data);
    }



    public function edit_web_app_blog(Request $request)
    {
        $user_id = $request->input('user_id');
        $blog_id = $request->input('blog_id');
        $blog_title = $request->input('blog_title');
        $blog_content = $request->input('blog_content');




        // Updating Data
        $blog = WebAppBlog::find($blog_id)  ;
        $blog->blog_title = $blog_title;
        $blog->blog_content = $blog_content;
        $blog->updated_at = now();



        // Checking Image is Available or Not then processing

        if ($request->hasFile('blog_image'))
        {
            if ($request->file('blog_image')->isValid()) {
                $validated = $request->validate([
                    'blog_image' => 'mimes:jpeg,png,jpg|max:5120'
                ]);

                /*$image_file = Helper::image_resize($request->file('blog_image'),940,480);
                $extension = $image_file->extension();*/










                $extension = $request->blog_image->extension();
                $image = 'blog_'.$blog_id.'.'.$extension;


                $url = 'uploads/web_blogs/'.$blog_id.'/';
                $path = $request->blog_image->storeAs($url, $image ,'public');


                // Final Url to Store in DB
                $url = $path;
                $blog->blog_photo_url = $url;
            }
        }
        $blog->save();
        return redirect('/web_app_blog')->with('success','Blog No : '.$blog_id.' Updated Successfully');
    }


    public function create_web_app_blog(Request $request)
    {
        $user_id = $request->input('user_id');
        $blog_title = $request->input('blog_title');
        $blog_content = $request->input('blog_content');



        // Getting number of available web App blogs in DataBase
        $count = DB::table('web_app_blog')->count();
        if($count<1)
            $blog_id = 0;
        else
            $blog_id = DB::table('web_app_blog')->max('blogID');
        $blog_id++;


        // Checking Null
        if($blog_title == null || $blog_content == null)
            return redirect('/web_app_blog')->with('error','Some Fields are Missing');


        $url = null;
        // Inserting Blog Image
        if ($request->hasFile('blog_image')) {
            if ($request->file('blog_image')->isValid()) {
                $validated = $request->validate([
                    'blog_image' => 'mimes:jpeg,png,jpg|max:5120'
                ]);


                $extension = $request->blog_image->extension();
                $image = 'blog_'.$blog_id.'.'.$extension;


                $url = 'uploads/web_blogs/'.$blog_id.'/';
                $path = $request->blog_image->storeAs($url, $image ,'public');



                // Final Url to Store in DB
                $url = $url.$image;
            }
        }


        $blog = new WebAppBlog();
        $blog->blogID = $blog_id;
        $blog->userID = $user_id;
        $blog->blog_title = $blog_title;
        $blog->blog_content = $blog_content;
        $blog->blog_photo_url = $url;
        $blog->created_at = now();
        $blog->save();


        return redirect('/web_app_blog')->with('success','New Blog Created Successfully');

    }


    public function delete_web_app_blog(Request $request)
    {
        $blog_id = $request->input('blog_id');

        // Deleting File With Image From Storage
        $directory = 'uploads/web_blogs/'.$blog_id;

        $response = File::deleteDirectory(storage_path('app/public/'.$directory));


        // Deleting Information from Database
        $success = DB::table('web_app_blog')->where('blogID',$blog_id)->delete();
        if ($success)
            return redirect('/web_app_blog')->with('success','Blog No : '.$blog_id.' Deleted Successfully');
        else
            return redirect('/web_app_blog')->with('error','Blog No : '.$blog_id.' Cannot be deleted');

    }
}
