<?php

namespace App\Imports;

use App\Verify_User;
use Maatwebsite\Excel\Concerns\ToModel;

class VerifyUser implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Verify_User([
            'firstname' => $row[''],
            'lastname' => $row['lastname'],
            'email' => $row['lastname'],
            'phone' => $row['lastname'],
            '' => $row['lastname'],
            'lastname' => $row['lastname'],
            'lastname' => $row['lastname'],
            'lastname' => $row['lastname'],
        ]);
    }
}
