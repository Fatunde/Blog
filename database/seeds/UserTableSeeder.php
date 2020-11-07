<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Damilare',
            'email' => 'fatundedamilare@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('bibilanky'),
            'email_verified_at' => null,
            'created_at'=> '2020-10-09',
            'paid'=> '1',
            'activated' => '1',
            'lastName' => 'Fatunde',
            'disable' => null,
            'avatar' => null,
            'post_counts' => 0,
        ]);
    }
}
