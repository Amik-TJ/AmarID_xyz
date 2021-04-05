<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use function GuzzleHttp\Promise\all;

class BlogController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index(){

        $blogs = Blog::all();

        //Checking Blog Table is empty or Not
        if($blogs->isEmpty())
        {
            $data = array(
                'found'=>false
            );
            return view('admin.blog')->with('data',$data);
        }


        $data = array(
            'found'=>true,
            'data' => $blogs,
        );
        return view('admin.blog')->with('data',$data);
    }



    public function edit_blog(Request $request)
    {
        $blog_id = $request->input('blog_id');
        $blog_title = $request->input('blog_title');
        $blog_content = $request->input('blog_content');


        // Updating Data
        $blog = Blog::find($blog_id);
        $blog->title = $blog_title;
        $blog->content = $blog_content;
        $blog->time = now();



        // Checking Image is Available or Not then processing

        if ($request->hasFile('blog_image'))
        {
            if ($request->file('blog_image')->isValid()) {
                $validated = $request->validate([
                    'blog_image' => 'mimes:jpeg,png,jpg|max:5120'
                ]);


                $extension = $request->blog_image->extension();
                $image_location = 'blog_'.$blog_id.'.'.$extension;
                $url = 'uploads/blogs/';


                $image = $request->file('blog_image');
                $storing_location = storage_path().'/app/public/uploads/blogs/'.$image_location;
                $image_resize = Image::make($image->getRealPath());
                $a = $image_resize->resize(960, 720);
                $image_resize->save($storing_location);


                // Final Url to Store in DB
                $url = $url.$image_location;
                $blog->imgUrl = $url;
            }
        }
        $blog->save();
        return redirect('/blog')->with('success','Blog No : '.$blog_id.' Updated Successfully');
    }


    public function create_blog(Request $request)
    {
        $blog_title = $request->input('blog_title');
        $blog_content = $request->input('blog_content');



        // Getting number of available Sub Fields in DataBase
        $count = DB::table('blogs')->count();
        if($count<1)
            $blog_id = 0;
        else
            $blog_id = DB::table('blogs')->max('blogID');
        $blog_id++;


        // Checking Null
        if($blog_title == null || $blog_content == null)
            return redirect('/blog')->with('error','Some Fields are Missing');


        $url = null;
        // Inserting Icon Image
        if ($request->hasFile('blog_image')) {
            if ($request->file('blog_image')->isValid()) {
                $validated = $request->validate([
                    'blog_image' => 'mimes:jpeg,png,jpg|max:5120'
                ]);


                $extension = $request->blog_image->extension();
                $image_location = 'blog_'.$blog_id.'.'.$extension;



                $image = $request->file('blog_image');
                $storing_location = storage_path().'/app/public/uploads/blogs/'.$image_location;
                $image_resize = Image::make($image->getRealPath());
                $a = $image_resize->resize(960, 720);
                $image_resize->save($storing_location);




                $url = 'uploads/blogs/';
                //$path = $request->blog_image->storeAs($url, $image ,'public');



                // Final Url to Store in DB
                $url = $url.$image_location;
            }
        }


        $blog = new Blog();
        $blog->blogID = $blog_id;
        $blog->title = $blog_title;
        $blog->imgUrl = $url;
        $blog->content = $blog_content;
        $blog->time = now();
        $blog->save();


        return redirect('/blog')->with('success','New Blog Created Successfully');

    }


    public function delete_blog(Request $request)
    {
        $blog_id = $request->input('blog_id');

        // Deleting File With Image From Storage
        $directory = 'uploads/blogs/'.$blog_id;
        $response = File::deleteDirectory(storage_path('app/public/'.$directory));


        // Deleting Information from Database
        $success = DB::table('blogs')->where('blogID',$blog_id)->delete();
        if ($success)
            return redirect('/blog')->with('success','Blog No : '.$blog_id.' Deleted Successfully');
        else
            return redirect('/blog')->with('error','Blog No : '.$blog_id.' Cannot be deleted');

    }
}
