<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categories = Category::pluck('id')->toArray();
        $suppliers = Supplier::pluck('id')->toArray();

        foreach(range(1,10) as $index) {
            $item = new Item;
            $item->item_name = $faker->word;
            $item->description = $faker->randomElement(['On stock', 'Out of stock']);
            $item->sellprice = $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000);
            $item->img_path = '/storage/images/' .$faker->image('public/storage/images',400,300, null, false);
            $item->sup_id = $faker->randomElement($suppliers);
            $item->cat_id = $faker->randomElement($categories);
            $item->created_at = $faker->dateTimeBetween('-1 year', 'now');
            $item->updated_at = $faker->dateTimeBetween('-1 year', 'now');
            $item->save();
        }
    }
    }

