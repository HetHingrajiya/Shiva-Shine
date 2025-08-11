<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@shivashine.com',
            'password' => Hash::make('shivashine@108'), // hashed password
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
