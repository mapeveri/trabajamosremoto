<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
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

        DB::table('categories')->insert([
            'name' => $name,
            'slug' => $slug,
        ]);
    }
}
