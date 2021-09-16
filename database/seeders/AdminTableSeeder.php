<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();
        DB::table('admins')->insert([
            'name' => 'Kishan Patel',
            'email' => 'kishan.urvam@gmail.com',
            'password' => bcrypt('123456xyz'),
            'status' => '1',
            'created_at' => \Carbon\Carbon::now(),
        ]);
    }
}
