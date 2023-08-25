<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        // Generate multiple products using faker
        foreach (range(1, 100) as $index) {
            $product = new Product();
            $product->name  = $faker->sentence;
            $product->price = $faker->numberBetween(1000, 100000);
            $product->image = $faker->imageUrl(640, 480);
            $product->save();
        }
    }
}
