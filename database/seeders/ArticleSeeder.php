<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'judul' => 'Manfaat Olahraga Pagi',
            'isi' => 'Olahraga pagi membuat tubuh lebih bugar dan meningkatkan fokus.',
            'doctor_id' => 1
        ]);

        Article::create([
            'judul' => 'Pola Makan Sehat untuk Mahasiswa',
            'isi' => 'Perbanyak makan buah, sayur, dan hindari junk food saat belajar.',
            'doctor_id' => 1
        ]);

        Article::create([
            'judul' => 'Tips Tidur Berkualitas',
            'isi' => 'Tidur cukup 7-8 jam dan kurangi penggunaan HP sebelum tidur.',
            'doctor_id' => 2
        ]);
    }
}
