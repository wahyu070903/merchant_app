<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use\App\Models\Products;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        Products::factory()->count(50)->create();
    }
}
