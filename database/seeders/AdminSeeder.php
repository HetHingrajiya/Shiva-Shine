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
        // Use updateOrCreate to prevent duplicate errors
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
    }
}
