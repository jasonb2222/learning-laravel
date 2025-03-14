<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 2000; $i++) {
            DB::table('products')->insert([
                'name' => fake()->words(3, true),
                'description' => fake()->paragraphs(3, true),
                'price' => fake()->randomDigit(),
                'stock' => fake()->numberBetween(5,15),
            ]);
        }
    }
}
