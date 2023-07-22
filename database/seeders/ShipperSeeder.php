<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shipper;
class ShipperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach(range(1,5) as $index) {
        $ship = new Shipper;
            $ship->name = $faker->randomElement(['UPS', 'FedEx', 'USPS', 'DHL','Palawan']);
            $ship->created_at = $faker->dateTimeBetween('-1 year', 'now');
            $ship->updated_at = $faker->dateTimeBetween('-1 year', 'now');
            $ship->save();
    }
    }
}
