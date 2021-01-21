<?php

namespace App\Http\Controllers;


use App\Models\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $packages = DB::table('packages')->get();
        return view('admin.package')->with('packages',$packages);
    }


    public function delete_package(Request $request)
    {
        $package_id = $request->input('package_id');
        $package_exists =  DB::table('orders')->where('packageID', $package_id)->exists();
        if($package_exists)
            return redirect('/package')->with('error','This Package has already orders');
        DB::table('packages')->where('packageID',$request->input('package_id'))->delete();
        return redirect('/package')->with('success','Package Deleted Successfully');
    }


    public function create_package(Request $request)
    {
        $this->validate($request,[

            'title'=>'required',
            'description'=>'required',
            'noOfSoftID'=>'required',
            'hardCopyIncluded'=>'required',
            'oneSidedCard'=>'required',
            'rounded_option' => 'required',
            'spot_option' => 'required',
            'texture_option' => 'required',
            'price'=>'required'
        ]);
        $round_price = $request->filled('round_price') ? $request->input('round_price') : 0;
        $spot_price = $request->filled('spot_price') ? $request->input('spot_price') : 0;
        $discount = $request->filled('discount') ? $request->input('discount') : 0;
        $no_of_soft_id = $request->filled('noOfSoftID') ? $request->input('noOfSoftID') : 0;

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

        $package = new Packages();
        $package->title = $request->input('title');
        $package->description = $request->input('description');
        $package->hardCopyIncluded = $request->input('hardCopyIncluded');
        $package->oneSidedCard = $request->input('oneSidedCard');
        $package->roundedOption = $request->input('rounded_option');
        $package->textureOption = $request->input('texture_option');
        $package->spotOption = $request->input('spot_option');
        $package->roundPrice = $round_price;
        $package->spotPrice = $round_price;
        $package->weight = $package_weight;
        $package->price = $request->input('price');
        $package->noOfSoftID = $no_of_soft_id;
        $package->discount = $discount;
        $package->save();
        return redirect('/package')->with('success','New Package Created Successfully');
    }


    public function edit_package(Request $request)
    {

        $request->validate([

            'title'=>'required',
            'description'=>'required',
            'no_of_soft_id'=>'required',
            'hard_copy_included'=>'required',
            'one_sided_card'=>'required',
            'rounded_option' => 'required',
            'spot_option' => 'required',
            'texture_option' => 'required',
            'price'=>'required'
        ]);

        $package_id = $request->input('package_id');
        $round_price = $request->filled('round_price') ? $request->input('round_price') : 0;
        $spot_price = $request->filled('spot_price') ? $request->input('spot_price') : 0;
        $discount = $request->filled('discount') ? $request->input('discount') : 0;
        $no_of_soft_id = $request->filled('noOfSoftID') ? $request->input('noOfSoftID') : 0;


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

        $package = Packages::find($package_id);
        $package->title = $request->input('title');
        $package->description = $request->input('description');
        $package->hardCopyIncluded = $request->input('hard_copy_included');
        $package->oneSidedCard = $request->input('one_sided_card');
        $package->roundedOption = $request->input('rounded_option');
        $package->textureOption = $request->input('texture_option');
        $package->spotOption = $request->input('spot_option');
        $package->roundPrice = $round_price;
        $package->spotPrice = $round_price;
        $package->weight = $package_weight;
        $package->price = $request->input('price');
        $package->noOfSoftID = $no_of_soft_id;
        $package->discount = $discount;
        $package->save();
        return redirect('/package')->with('success','Package No : '.$package_id.' Updated Successfully');
    }
}
