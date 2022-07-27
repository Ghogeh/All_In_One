<?php

namespace App\Exports;

use App\Models\User;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements WithHeadings, FromQuery, WithMapping
{
    function query()
    {
        return User::query();
    }

    function headings(): array
    {
       return ['id', 'name', 'email', 'password'];
    }

    function map($row): array
    {
        return [$row->id, $row->name, $row->email, $row->password];
    }
}
