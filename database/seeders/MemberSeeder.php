<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['Budi Santoso', '2024001', 'budi@mail.test', '081234567890', 'Jl. Merdeka No. 1, Jakarta'],
            ['Siti Nurhaliza', '2024002', 'siti@mail.test', '081234567891', 'Jl. Sudirman No. 2, Bandung'],
            ['Andi Wijaya', '2024003', 'andi@mail.test', '081234567892', 'Jl. Diponegoro No. 3, Surabaya'],
            ['Dewi Lestari', '2024004', 'dewi@mail.test', '081234567893', 'Jl. Gajah Mada No. 4, Yogyakarta'],
            ['Rudi Hartono', '2024005', 'rudi@mail.test', '081234567894', 'Jl. Ahmad Yani No. 5, Semarang'],
            ['Maya Sari', '2024006', 'maya@mail.test', '081234567895', 'Jl. Pahlawan No. 6, Malang'],
            ['Eko Prasetyo', '2024007', 'eko@mail.test', '081234567896', 'Jl. Kartini No. 7, Solo'],
            ['Rina Wati', '2024008', 'rina@mail.test', '081234567897', 'Jl. Imam Bonjol No. 8, Medan'],
        ];

        foreach ($members as $m) {
            Member::updateOrCreate(
                ['nis_nim' => $m[1]],
                [
                    'name' => $m[0],
                    'nis_nim' => $m[1],
                    'email' => $m[2],
                    'phone' => $m[3],
                    'address' => $m[4],
                    'status' => 'active',
                ]
            );
        }
    }
}
