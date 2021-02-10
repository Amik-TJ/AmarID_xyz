<?php

namespace App\Http\Controllers;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateController extends Controller
{

   public function create_business_card(Request $request)
   {
       $this->validate($request,[

           'first_name'=>'required',
           'last_name'=>'required',
           'title'=>'required',
           'phone_business'=>'required|max:11|min:11|unique:App\Models\Card,phone_business|unique:App\Models\Card,phone_personal',
           'phone_personal'=>'unique:App\Models\Card,phone_personal|required|max:11|min:11',
           'email_business'=>'required|unique:App\Models\Card,email_business',
           'email_personal'=>'email|unique:App\Models\Card,email_personal',
           'street_address'=>'required',
           'city'=>'required',
           'country'=>'required',
       ]);
       $card = new Card();
       $card->userID = Auth::id();;
       $card->firstname = $request->input('first_name');
       $card->lastname = $request->input('last_name');
       $card->designation = $request->input('title');
       $card->street = $request->input('street_address');
       $card->zipcode = $request->input('zip_code');
       $card->city = $request->input('city');
       $card->country = $request->input('country');
       $card->company = $request->input('company_name');
       $card->email_personal = $request->input('email_personal');
       $card->email_business = $request->input('email_business');
       $card->phone_personal = $request->input('phone_personal');
       $card->phone_business = $request->input('phone_business');
       $card->website = $request->input('website');
       $card->softID = 50;
       $card->save();
       return redirect('/')->with('success','Business Card Created Successfully');
   }
}
