<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PaymentMethodSeeder::class);
        $this->call(ShipperSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ItemSeeder::class);
    }
}
