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
        // First Admin - Super Admin
        \App\Models\Admin::updateOrCreate(
            ['email' => 'admin@shivashine.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('shivashine@108'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        
        echo "✓ Admin account created/updated: admin@shivashine.com\n";
        
        // Second Admin - Het Hingrajiya
        \App\Models\Admin::updateOrCreate(
            ['email' => 'het@shivashine.com'],
            [
                'name' => 'Het Hingrajiya',
                'password' => Hash::make('het@123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        
        echo "✓ Admin account created/updated: het@shivashine.com\n";
    }
}
