<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $faker = Factory::create();

        for ($i = 0; $i < 3; $i++) {
            Category::create([
                'title' => $faker->name
            ]);
            Brand::create([
                'title' => $faker->name
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            Product::create([
                'title' => $faker->name,
                'size' => $faker->randomElement($array = array('sm', 'xl', '2xl')),
                'color' => $faker->colorName,
                'brand_id' => $faker->numberBetween(1, 3),
                // 'brand_id' => 1,
                'category_id' => $faker->numberBetween(1, 3),
                // 'category_id' => 1,
                'arrival_time' => $faker->date(),
            ]);
        }
    }
}
