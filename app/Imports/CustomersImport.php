<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomersImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $user = User::create([
                'name' => $row['first_name'] . " " . $row['last_name'],
                'email' => $row['email'],
                'password' => Hash::make('password'),
                'usertype' => $row['account'],
            ]);
            $customer = $user->customer()->create([
                'customer_name' => $row['first_name'] . " " . $row['last_name'],
                'contact' => $row['contact'],
                'address' => $row['address'],
                'img_pathC' => $row['image'],
            ]);
        }
    }
}
