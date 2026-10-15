<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Sejarah',
            'Visi, Misi, Tujuan & Nilai Dasar',
            'Struktur Organisasi',
            'Fasilitas',
        ];

        foreach ($titles as $i => $title) {
            Page::firstOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'content' => 'Konten halaman ini belum diisi. Silakan isi melalui dashboard admin.',
                    'sort_order' => $i + 1,
                ]
            );
        }
    }
}