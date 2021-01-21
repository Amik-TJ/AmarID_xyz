<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $data = array(
            'modal' => false,
        );

        return view('welcome')->with('data',$data);
    }
}
