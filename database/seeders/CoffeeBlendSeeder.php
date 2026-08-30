<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CoffeeBlendSeeder extends Seeder
{
    public function run(): void
    {
        $coffee = Category::create([
            'name' => 'Coffee',
            'description' => 'Berbagai pilihan kopi CoffeeBlend',
        ]);

        $nonCoffee = Category::create([
            'name' => 'Non Coffee',
            'description' => 'Minuman non-kopi CoffeeBlend',
        ]);

        $food = Category::create([
            'name' => 'Food',
            'description' => 'Makanan dan pastry CoffeeBlend',
        ]);

        Product::create([
            'category_id' => $coffee->id,
            'name' => 'Americano',
            'description' => 'Espresso dengan air yang menghasilkan rasa kopi yang ringan dan clean.',
            'price' => 18000,
            'stock' => 50,
        ]);

        Product::create([
            'category_id' => $coffee->id,
            'name' => 'Cafe Latte',
            'description' => 'Espresso dengan steamed milk yang creamy.',
            'price' => 25000,
            'stock' => 50,
        ]);

        Product::create([
            'category_id' => $coffee->id,
            'name' => 'Cappuccino',
            'description' => 'Espresso dengan perpaduan steamed milk dan foam.',
            'price' => 25000,
            'stock' => 50,
        ]);

        Product::create([
            'category_id' => $nonCoffee->id,
            'name' => 'Matcha Latte',
            'description' => 'Matcha premium dengan susu creamy.',
            'price' => 28000,
            'stock' => 40,
        ]);

        Product::create([
            'category_id' => $nonCoffee->id,
            'name' => 'Chocolate',
            'description' => 'Minuman cokelat creamy dengan rasa cokelat yang rich.',
            'price' => 24000,
            'stock' => 40,
        ]);

        Product::create([
            'category_id' => $food->id,
            'name' => 'Butter Croissant',
            'description' => 'Croissant renyah dengan aroma butter.',
            'price' => 20000,
            'stock' => 30,
        ]);

        Product::create([
            'category_id' => $food->id,
            'name' => 'Chocolate Cake',
            'description' => 'Cake cokelat lembut dengan rasa cokelat yang rich.',
            'price' => 28000,
            'stock' => 20,
        ]);
    }
}