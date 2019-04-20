<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = str_random(10);
        $slug = Str::slug($title, '-');
        $category = \App\Category::all()->first();
        $user = \App\User::all()->first();

        DB::table('jobs')->insert([
            'title' => $title,
            'slug' => $slug,
            'content' => 'Test post',
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $job = \App\Job::all()->first();
        $job->subcategories()->sync([$category->subcategories[0]->id]);
    }
}
