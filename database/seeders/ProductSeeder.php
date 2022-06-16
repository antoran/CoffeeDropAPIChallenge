<?php

namespace Database\Seeders;

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
        \App\Models\Product::factory()->create([
            'name' => 'Ristretto',
            'prices' => [
                '0' => 0.02,
                '51' => 0.03,
                '501' => 0.05,
            ]
        ]);

        \App\Models\Product::factory()->create([
            'name' => 'Espresso',
            'prices' => [
                '0' => 0.04,
                '51' => 0.06,
                '501' => 0.1,
            ]
        ]);

        \App\Models\Product::factory()->create([
            'name' => 'Lungo',
            'prices' => [
                '0' => 0.05,
                '51' => 0.1,
                '501' => 0.15,
            ]
        ]);
    }
}
