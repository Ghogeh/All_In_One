<?php

namespace App\Imports;

use App\Models\Product;
// use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ProductImport implements  WithHeadingRow, SkipsEmptyRows, WithBatchInserts, ToCollection
{
    // /**
    // * @param array $row
    // *
    // * @return \Illuminate\Database\Eloquent\Model|null
    // */
    // public function model(array $row)
    // {
    //     return new Product([
    //         //
    //     ]);
    // }
     function collection(Collection $rows)
    {

           foreach($rows as $row) {
            User::create([
                'name' => $row['name'],
                'price' => $row['price'],
                'quantity' => $row['quantity']
            ]);
           }

    }

    function rules() : array {
        return [
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ];
    }

    function headingRow() : int {
        return 1;
    }

    function batchSize() : int {
        return 100;
    }



}
