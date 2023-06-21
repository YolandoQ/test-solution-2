<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $productNames = [
            'Smartphone',
            'Notebook',
            'Cafeteira Elétrica',
            'Geladeira/Refrigerador',
            'Smart TV',
            'Lavadora',
            'Air Fryer',
            'Headset Gamer',
            'Batedeira'
        ];

        for ($i = 0; $i < 5; $i++) {
            \DB::table('products')->insert([
                'name' => $faker->randomElement($productNames), 
                'price' => $faker->randomFloat(2, 5, 200),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
