<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = str_random(10);
        $slug = Str::slug($name, '-');
        $category = \App\Category::all()->first();

        DB::table('sub_categories')->insert([
            'name' => $name,
            'slug' => $slug,
            'category_id' => $category->id,
        ]);
    }
}
