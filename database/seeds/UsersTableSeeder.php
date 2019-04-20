<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'test1',
                'email' => 'test1@email-test.com',
                'username' => 'test_username_' . str_random(10),
                'password' => bcrypt('secret'),
                'is_admin' => false,
            ], [
                'name' => 'test-admin',
                'email' => 'test-admin@email-test.com',
                'username' => 'test_admin_username_' . str_random(10),
                'password' => bcrypt('secret'),
                'is_admin' => true,
            ]
        ]);
    }
}
