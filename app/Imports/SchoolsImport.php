<?php

namespace App\Imports;

use App\Models\School;
use Maatwebsite\Excel\Concerns\ToModel;

class SchoolsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new School([
            'name' => $row[1],
            'description' => $row[2],
            'country' => $row[3],
            'city' => $row[4],
            'address' => $row[5],
            'logo' => $row[6],
            'language' => $row[7]
        ]);
    }
}
