<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Category();
        $category->name = 'Technology';
        $category->save();

        $category = new \App\Category();
        $category->name = 'Excercise';
        $category->save();

        $category = new \App\Category();
        $category->name = 'Math';
        $category->save();

        $category = new \App\Category();
        $category->name = 'Physical';
        $category->save();

        $category = new \App\Category();
        $category->name = 'Art';
        $category->save();
    }
}
