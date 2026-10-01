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
