<?php

namespace App\Imports;

use App\Models\Shipper;
use Maatwebsite\Excel\Concerns\ToModel;

class ShippersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Shipper([
            //
        ]);
    }
}
