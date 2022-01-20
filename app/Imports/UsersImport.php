<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'uid' => $row[1],
            'username' => $row[2],
            'email' => $row[3],
            'email_verified_at' => $row[4],
            'password' => $row[5],
            'type' => $row[6],
            'school_id' => $row[7],
            'nationality' => $row[8],
            'country' => $row[9],
            'city' => $row[10],
            'address' => $row[11],
            'birth_date' => $row[12],
            'mobile_number' => $row[13],
            'telephone_number' => $row[14],
            'image' => $row[15],
            'first_name' => $row[16],
            'middle_name' => $row[17],
            'last_name' => $row[18],
            'academic' => $row[19],
            'created_by' => $row[20],
            'updated_by' => $row[21]
        ]);
    }
}
