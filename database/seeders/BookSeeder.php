<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '9789793062792', 2005, 'Fiksi', 5],
            ['Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', '9789799731234', 1980, 'Fiksi', 3],
            ['Perahu Kertas', 'Dee Lestari', 'Bentang Pustaka', '9786020364443', 2009, 'Fiksi', 4],
            ['Harry Potter dan Batu Bertuah', 'J.K. Rowling', 'Gramedia', '9789792218434', 2000, 'Fiksi', 6],
            ['Sapiens', 'Yuval Noah Harari', 'Kepustakaan Populer Gramedia', '9786024240323', 2017, 'Non-Fiksi', 2],
            ['Bumi', 'Tere Liye', 'Gramedia', '9786020333467', 2014, 'Fiksi', 3],
            ['Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia', '9789792248895', 2009, 'Fiksi', 4],
            ['Filosofi Teras', 'Henry Manampiring', 'Kompas', '9786024125185', 2018, 'Non-Fiksi', 2],
            ['Clean Code', 'Robert C. Martin', 'Prentice Hall', '9780132350884', 2008, 'Teknologi', 2],
            ['Laravel Up & Running', 'Matt Stauffer', 'OReilly', '9781492041214', 2019, 'Teknologi', 1],
            ['One Piece Vol. 1', 'Eiichiro Oda', 'Elex Media', '9789792249999', 1997, 'Komik', 10],
            ['Naruto Vol. 1', 'Masashi Kishimoto', 'Elex Media', '9789792248888', 1999, 'Komik', 8],
            ['Doraemon Vol. 1', 'Fujiko F. Fujio', 'Elex Media', '9789792247777', 1969, 'Komik', 7],
            ['Matematika SMA Kelas 10', 'Kemendikbud', 'Kemendikbud', '9786021234567', 2020, 'Pelajaran', 15],
            ['Bahasa Indonesia Kelas 11', 'Kemendikbud', 'Kemendikbud', '9786021234568', 2020, 'Pelajaran', 12],
            ['Fisika Dasar', 'Halliday Resnick', 'Erlangga', '9789791234567', 2010, 'Pelajaran', 5],
            ['Atomic Habits', 'James Clear', 'Gramedia', '9786020633174', 2019, 'Non-Fiksi', 3],
            ['Rich Dad Poor Dad', 'Robert Kiyosaki', 'Gramedia', '9789792256789', 2000, 'Non-Fiksi', 4],
            ['The Hobbit', 'J.R.R. Tolkien', 'Gramedia', '9789792212345', 1937, 'Fiksi', 3],
            ['Dilan 1990', 'Pidi Baiq', 'Pastel Books', '9786027870053', 2014, 'Fiksi', 5],
        ];

        foreach ($books as $b) {
            $cat = Category::where('name', $b[5])->first();
            if (!$cat) continue;

            Book::updateOrCreate(
                ['isbn' => $b[3]],
                [
                    'title' => $b[0],
                    'author' => $b[1],
                    'publisher' => $b[2],
                    'isbn' => $b[3],
                    'year' => $b[4],
                    'category_id' => $cat->id,
                    'stock' => $b[6],
                ]
            );
        }
    }
}
