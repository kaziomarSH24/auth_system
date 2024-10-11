<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() == 0) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make("12345678"),
                'role' => 'admin',
                'email_verified_at' => Carbon::now(),
            ]);

            User::create([
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => Hash::make("12345678"),
                'role' => 'user',
                'email_verified_at' => Carbon::now(),
            ]);
        }
    }
}
