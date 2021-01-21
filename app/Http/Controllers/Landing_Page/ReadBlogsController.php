<?php

namespace App\Http\Controllers\Landing_Page;
use App\Http\Controllers\Controller;
use App\Models\WebAppBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReadBlogsController extends Controller
{


    public function index()
    {
        $blogs = DB::table('web_app_blog as w')
            ->join('users as u', 'w.userID', '=', 'u.userID')
            ->select( 'w.blogID','w.userID','w.blog_title','w.blog_content','w.blog_photo_url','w.created_at','w.updated_at','u.firstname','u.lastname','u.phone','u.email')
            ->orderBy('w.created_at','desc')
            ->get();


        if($blogs->isEmpty())
        {
            $data = array(
                'found' => false,
            );
        }else{
            $data = array(
                'found' => true,
                'data' => $blogs
            );
        }
        return view('landing_page.read_blogs')->with('data',$data);
    }


    public function read_full_web_blog(Request $request)
    {

        $request->validate([
            'blog_id' => 'required'
        ]);
        $blog_id = $request->input('blog_id');



        $blog = DB::table('web_app_blog as w')
            ->join('users as u', 'w.userID', '=', 'u.userID')
            ->select( 'w.blogID','w.userID','w.blog_title','w.blog_content','w.blog_photo_url','w.created_at','w.updated_at','u.firstname','u.lastname','u.phone','u.email')
            ->where('blogID',$blog_id)
            ->get()
            ->first();



        if($blog == null)
        {
            $data = array(
                'found' => false
            );
        }else{
            $data = array(
                'found' => true,
                'data' => $blog,
            );
        }
        return view('landing_page.read_full_blog')->with('data',$data);

    }


    public function no_blog_id()
    {
        return redirect('/read_blogs')->with('error','No Blog is Selected');
    }
}
