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
        if (! DB::table('users')->where('email', 'developers@fishtankagency.com')->count()) {
            DB::table('users')->insert([
                'type' => 'admin',
                'name' => 'Fishtank Agency',
                'email' => 'developers@fishtankagency.com',
                'password' => bcrypt('fishtank1977'),
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
