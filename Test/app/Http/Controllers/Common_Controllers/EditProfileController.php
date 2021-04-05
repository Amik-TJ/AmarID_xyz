<?php

namespace App\Http\Controllers\Common_Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EditProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        return view('common_views.edit_profile');
    }
    public function change_password(Request $request)
    {
        $request->validate([
            'new_password' => 'required',
        ]);




        $user_id = auth()->user()->userID;
        $new_password = $request->input('new_password');
        $old_password = $request->input('old_password');



        if(strlen($new_password) < 6)
            return redirect('/edit_profile')->with('error','Password Must be at least 6 characters');

        $user = User::find($user_id);

        // Getting Old Password
        $pwd = $user->password;

        if($old_password == $pwd)
        {
            $user->password = $new_password;
            $user->save();
            return redirect('/edit_profile')->with('success','Password Changed Successfully');
        }else
            return redirect('/edit_profile')->with('error','Incorrect Previous Password');

    }


    public function change_profile_picture(Request $request)
    {
        $request->validate([
            'photo' => 'required|mimes:jpg,png,jpeg',
        ]);



        $user_id = auth()->user()->userID;
        $user = User::find($user_id);


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            if ($file->isValid()) {
                // Extension
                $extension = $file->extension();


                // Storing Location /uploads/photos/3.jpg
                $storing_location = '/uploads/photos/';
                $file_name_server = $user_id.'.'.$extension;

                // Storing File
                $path = $file->storeAs($storing_location, $file_name_server,'public');
                if ($path != null)
                {
                    $user->photo_url = $storing_location.$file_name_server;
                    $user->save();
                    return redirect('/edit_profile')->with('success','Profile Photo Uploaded Successfully');
                }else
                {

                }
            }else{
                return redirect('/edit_profile')->with('error','Profile Photo Cannot be Uploaded');
            }
        }else{
            return redirect('/edit_profile')->with('error','Profile Photo Cannot be Uploaded');
        }

    }
}
