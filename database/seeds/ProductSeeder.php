<?php

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
        $product = new \App\Product();
        $product->name = 'Book1';
        $product->price = '12000';
        $product->category_id = '1';
        $product->save();

        $product = new \App\Product();
        $product->name = 'Book2';
        $product->price = '12000';
        $product->category_id = '2';
        $product->save();

        $product = new \App\Product();
        $product->name = 'Book3';
        $product->price = '12000';
        $product->category_id = '3';
        $product->save();

        $product = new \App\Product();
        $product->name = 'Book4';
        $product->price = '12000';
        $product->category_id = '4';
        $product->save();

        $product = new \App\Product();
        $product->name = 'Book5';
        $product->price = '12000';
        $product->category_id = '5';
        $product->save();
    }
}
