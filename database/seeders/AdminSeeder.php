<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder; // Jangan lupa tambahkan ini
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder // Pastikan class ini extend Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'usertype' => 'admin',
        ]);
    }
}
