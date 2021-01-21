<?php

namespace App\Http\Controllers;

use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeightController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index()
    {
        $weights = Weight::all();


        $data = array(
            'found' => false
        );
        if($weights->isEmpty())
            return view('admin.weight')->with('data',$data);


        $data = array(
            'found' => true,
            'data' => $weights,
        );
        return view('admin.weight')->with('data',$data);
    }
}
