<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com', // Change to your admin email
            'password' => Hash::make('admin123'), // Change to your desired password
            'is_admin' => true, // Add this if you have an admin flag
        ]);

        $this->command->info('Admin user created successfully!');
    }
}