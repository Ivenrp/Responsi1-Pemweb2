<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiksi', 'description' => 'Novel, cerpen, roman'],
            ['name' => 'Non-Fiksi', 'description' => 'Biografi, sejarah, sains'],
            ['name' => 'Komik', 'description' => 'Komik & manga'],
            ['name' => 'Pelajaran', 'description' => 'Buku sekolah & kuliah'],
            ['name' => 'Teknologi', 'description' => 'Programming, komputer, IT'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['name' => $cat['name']], $cat);
        }
    }
}
