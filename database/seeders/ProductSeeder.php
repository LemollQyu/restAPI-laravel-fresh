<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $user = User::where( 'id', 1 )->first();

        // seeder productnya


        $productNames = [
            'iPhone 15', 'Samsung Galaxy S23', 'MacBook Pro M2', 'Dell XPS 13', 'Sony WH-1000XM5',
            'Logitech MX Master 3S', 'Asus ROG Zephyrus G14', 'Apple Watch Series 9', 'Nike Air Force 1',
            'Adidas Ultraboost', 'Xiaomi Redmi Note 12', 'Google Pixel 7', 'PlayStation 5', 'Xbox Series X',
            'Lenovo ThinkPad X1 Carbon', 'Samsung 4K Smart TV', 'Bose QuietComfort 45', 'Razer BlackWidow V4',
            'Canon EOS R6', 'Fujifilm X-T5', 'DJI Mini 3 Pro', 'GoPro Hero 11', 'Sony A7 IV', 'Nintendo Switch OLED',
            'MSI GeForce RTX 4090', 'AMD Ryzen 9 7950X', 'Intel Core i9-13900K', 'Corsair K95 RGB Platinum',
            'HyperX Cloud Alpha', 'JBL Flip 6', 'Anker PowerCore 20,000mAh', 'Epson EcoTank L3250'
        ];

        foreach ($productNames as $product) {
            Product::create([
                'user_id' => $user->id,
                'name' => $product,
                'description' => 'Produk ' . $product . ' dengan fitur terbaik di kelasnya.',
                'price' => rand(100000, 50000000),
            ]);
        }
    }
}
