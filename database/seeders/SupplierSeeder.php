<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 5) as $index) {
            $sup = new Supplier;
            $sup->sup_name = $faker->name;
            $sup->sup_contact = $faker->phoneNumber;
            $sup->sup_address = $faker->address;
            $sup->sup_email = $faker->email;
            $sup->created_at = $faker->dateTimeBetween('-1 year', 'now');
            $sup->updated_at = $faker->dateTimeBetween('-1 year', 'now');
            $sup->save();
        }
    }
}
