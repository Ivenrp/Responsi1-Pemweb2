<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@pustakaku.test'],
            [
                'name' => 'Admin PustakaKu',
                'password' => bcrypt('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@pustakaku.test'],
            [
                'name' => 'Staff PustakaKu',
                'password' => bcrypt('password123'),
                'role' => 'staff',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@pustakaku.test'],
            [
                'name' => 'User Biasa',
                'password' => bcrypt('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            CategorySeeder::class,
            BookSeeder::class,
            MemberSeeder::class,
            LoanSeeder::class,
        ]);
    }
}
