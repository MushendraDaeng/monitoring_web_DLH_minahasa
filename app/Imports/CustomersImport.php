<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomersImport implements ToModel, WithHeadingRow
{
    
    public function model(array $row)
    {
        // dd($row);
        return new Customer([
            'name'  => $row['nama_pelanggan'],
            'urban_village' => $row['kelurahan'],
            'sub_district'    => $row['kecamatan'],
            'status'    => $row['status'],
            'tarif'    => $row['tarif'],
        ]);
    }
}
