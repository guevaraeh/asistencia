<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash;
use Illuminate\Support\Str;

class TeachersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Teacher([
            'lastname' => $row['apellidos'],
            'name'     => $row['nombres'],
            'email'    => $row['email'],
            'area'     => $row['area'],
            'remember_token'     => Str::random(50),
        ]);
    }

    /*public function rules(): array
    {
        return [
            'name' => 'required|max:200',
            'lastname' => 'required|max:200',
            'email' => 'required|email|max:100',
            'area' => 'required|min:6|max:100',
        ];
    }*/
}
