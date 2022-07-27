<?php

namespace App\Imports;

use App\Models\User;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserImport implements WithHeadingRow, SkipsEmptyRows, WithBatchInserts, ToCollection
{

    function collection(Collection $rows)
    {

           foreach($rows as $row) {
            User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => Hash::make($row['password'])
            ]);
           }

    }

    function rules() : array {
        return [
            'name' => 'required',
            'email' => Rule::unique('users', 'email'),
            'password' => 'required'
        ];
    }

    function headingRow() : int {
        return 1;
    }

    function batchSize() : int {
        return 100;
    }

}
