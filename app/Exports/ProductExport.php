<?php

namespace App\Exports;

use App\Models\Product;
// use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;



class ProductExport implements WithHeadings, FromQuery, WithMapping
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Product::all();
    // }

    function query()
    {
        return Product::query();
    }

    function headings(): array
    {
       return ['id', 'name', 'price', 'quantity'];
    }

    function map($row): array
    {
        return [$row->id, $row->name, $row->price, $row->quantity];
    }
}
