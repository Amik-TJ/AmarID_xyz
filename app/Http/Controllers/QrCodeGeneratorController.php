<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeGeneratorController extends Controller
{
    public function index(Request $request)
    {

        // here our data
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $designation = $request->input('title');
        $phone_personal = $request->input('phone_personal');
        $phone_business = $request->input('phone_business');
        $email_personal = $request->input('email_personal');
        $email_business = $request->input('email_business');
        $company_name = $request->input('company_name');
        // if not used - leave blank!
        $street_address    = $request->input('street_address');
        $city = $request->input('city');
        $zip_code = $request->input('zip_code');
        $country   = $request->input('country');

        // we building raw data
        $codeContents  = 'BEGIN:VCARD'."\n";
        $codeContents .= 'VERSION:2.1'."\n";
        $codeContents .= 'N:'.$last_name."\n";
        $codeContents .= 'FN:'.$first_name."\n";
        $codeContents .= 'ORG:'.$company_name."\n";

        $codeContents .= 'TEL;WORK;VOICE:'.$phone_business."\n";
        $codeContents .= 'TEL;HOME;VOICE:'.$phone_personal."\n";


        $codeContents .= 'ADR;TYPE=work;'.
            'LABEL="'.$street_address.'":'
            .$city.';'
            .$zip_code.';'
            .$country."\n";

        $codeContents .= 'Email Personal:'.$email_personal." Email Business: ".$email_business."\n";

        $codeContents .= 'END:VCARD';
        $card = [
            'token' => true,
            'card_string' => $codeContents
        ];
        return view('welcome')->with('card',$card);
    }
}
