<?php

namespace App\Imports;

use App\Models\Card;
use App\Models\SubField;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VerifyUserImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // name splitting
        $name = explode(' ', $row['name']);
        $name[1] = count($name) < 2 ? null : $name[1];





        // Getting Sub Field ID
        $sub_fields = SubField::get();
        $sub_field_id = null;
        foreach ($sub_fields as $sb)
        {
            if($sb->subFieldName == $row['service_type'])
            {
                $sub_field_id = $sb->subFieldID;
                break;
            }
        }

        if($sub_field_id == null)
        {
            $sub_field = new SubField();
            $sub_field->fieldID = 10;
            $sub_field->subFieldName = $row['service_type'];
            $sub_field->translation = 'Blank';
            $sub_field->save();
            $sub_field_id = $sub_field->subFieldID;
         }

        $field_id = DB::table('sub_field')->where('subFieldID', $sub_field_id)->value('fieldID');
        $account_type_id = DB::table('field')->where('fieldID', $field_id)->value('accTypeID');

        $phone = strval($row['phone']);

        if(!empty($phone))
        {
            if($phone[0] == '0')
                $phone = substr($phone,1);
            $phone = '0'.$phone;
            $email = $row['email'];
            $all_phone = User::where('phone',$phone)->get();
            $all_email = User::where('email',$email)->get();
            if($all_phone->isEmpty() && $all_email->isEmpty())
            {

                // Email Checking
                $email = $row['email'] == '$$$' ? null : ($row['email'] == '***' ? null : $row['email']);
                $user =  new User();
                $user->firstname = $name[0];
                $user->lastname = $name[1];
                $user->phone = $phone;
                $user->email = $email;
                $user->location = $row['service_area'];
                $user->active = 0;
                $user->accTypeID = $account_type_id;
                $user->fieldID = $field_id;
                $user->subFieldID = $sub_field_id;
                $user->save();


                $card = new Card();
                $card->userID = $user->userID;
                $card->firstname = $name[0];
                $card->lastname = $name[1];
                $card->designation = $row['designation'];
                $card->street = $row['service_area'];
                $card->city = 'Dhaka';
                $card->country = 'Bangladesh';
                $card->email_business = $email;
                $card->phone_business = $phone;
                $card->softID = '100';
                $card->save();

                return $user;
            }else
            {
                return;
            }
        }else
        {
            return;
        }



    }
}
