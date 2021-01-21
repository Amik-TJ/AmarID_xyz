<?php

namespace App\Http\Controllers\Landing_Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CareerController extends Controller
{


    public function index()
    {
        return view('landing_page.career');
    }
}
