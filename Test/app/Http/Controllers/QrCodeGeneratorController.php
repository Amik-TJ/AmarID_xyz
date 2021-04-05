<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeGeneratorController extends Controller
{
    public function index(Request $request)
    {


        $qr_string = $this->qr_code_string_generator($request);
        $path = $this->generate_qr_path();



        QrCode::format('png')->size(200)->generate($qr_string, storage_path().'/app/public/'.$path);


        $card = [
            'token' => true,
            'card_string' => $qr_string,
            'qr_path' => $path,
        ];
        return view('welcome')->with('card',$card);
    }


    public function qr_code_string_generator(Request $request)
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

        return $codeContents;
    }


    public function generate_qr_path()
    {
        // Creating Storing Location if not exists
        if (!file_exists(storage_path().'/app/public/qrcodes/')) {
            mkdir(storage_path().'/app/public/qrcodes/', 777, true);
        }

        $files = File::files(storage_path().'/app/public/qrcodes/');


        $file_count = 0;
        if ($files !== false) {
            $file_count = count($files);
        }


        if($file_count>100)
        {
            File::cleanDirectory(storage_path().'/app/public/qrcodes/');
            $file_no = 1;
        }else{
            $file_no = $file_count + 1;
        }

        $path = 'qrcodes/qrcode_'.$file_no.'.png';
        return $path;

    }
}
