<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach(range(1,5) as $index) {
        $pm = new PaymentMethod;
            $pm->Methods = $faker->creditCardType;
            $pm->created_at = $faker->dateTimeBetween('-1 year', 'now');
            $pm->updated_at = $faker->dateTimeBetween('-1 year', 'now');
            $pm->save();
    }
}
}
