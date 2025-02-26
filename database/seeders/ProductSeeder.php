<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Gold Coffee',
            'description' => 'A premium blend of high-quality coffee beans.',
            'primary_product' => true,
            'profit_margin'=>25
        ]);

        Product::create([
            'name' => 'Arabic Coffee',
            'description' => 'Traditional Arabic coffee with a rich and aromatic taste.',
            'profit_margin'=>15
        ]);

    }
}
