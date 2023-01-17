<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    protected $model = Products::class;
    public function definition()
    {
        return [
            'product_name' => $this->faker->name,
            'category' => $this->faker->randomElement(['clothes','sticker','badges','other']),
            'product_description' => $this->faker->text,
            'price' => $this->faker->randomNumber(3,false),
            'image' => $this->faker->randomElement(['clothes.jpg','sticker.jpg','badges.jpg','other.jpg']),
        ];
    }
}
