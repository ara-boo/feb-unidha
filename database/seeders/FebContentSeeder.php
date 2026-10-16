<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\StudyProgram;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FebContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedProgramUrls();
        $this->seedVisionPage();
    }

    private function seedProgramUrls(): void
    {
        $urls = [
            'd3-akuntansi'            => 'https://d3akuntansi.unidha.ac.id/',
            'd3-manajemen-perusahaan' => 'https://d3manajemen.unidha.ac.id/',
            's1-manajemen'            => 'https://manajemen.unidha.ac.id/',
            's1-akuntansi'            => 'https://akuntansi.unidha.ac.id/',
            'd4-akuntansi-perpajakan' => 'https://akuntansiperpajakan.unidha.ac.id/',
            's1-bisnis-digital'       => 'https://bisnisdigital.unidha.ac.id/',
            's1-pariwisata'           => 'https://pariwisata.unidha.ac.id/',
            's2-manajemen'            => 'https://mm.feb.unidha.ac.id/',
        ];

        foreach ($urls as $slug => $url) {
            StudyProgram::where('slug', $slug)
                ->whereNull('website_url')
                ->update(['website_url' => $url]);
        }

        // Samakan nama dengan penulisan di web FEB.
        StudyProgram::where('slug', 'd4-akuntansi-perpajakan')
            ->where('name', 'Akuntansi Perpajakan')
            ->update(['name' => 'Terapan Akuntansi Perpajakan']);

        StudyProgram::where('slug', 's2-manajemen')
            ->where('name', 'Manajemen')
            ->update(['name' => 'Magister Manajemen']);
    }

    private function seedVisionPage(): void
    {
        $title = 'Visi, Misi, Tujuan & Nilai Dasar';

        $page = Page::where('title', 'like', 'Visi, Misi%')->first()
            ?? new Page([
                'title' => $title,
                'slug' => Str::slug($title),
                'sort_order' => 2,
            ]);

        // Jangan menimpa isi yang sudah diisi admin.
        if ($page->exists && ! str_contains((string) $page->content, 'belum diisi')) {
            return;
        }

        $page->content = <<<'MD'
## Visi

> _Menjadi Fakultas Ekonomi dan Bisnis yang dipercaya dalam menghasilkan lulusan berdaya saing, inovatif, adaptif dan berorientasi pada keberlanjutan._

## Karakter Lulusan

### Berdaya Saing
_Teks belum diisi._

### Inovatif
_Teks belum diisi._

### Adaptif
_Teks belum diisi._

### Berorientasi pada Keberlanjutan
_Teks belum diisi._

## Misi

### Pendidikan
_Teks belum diisi._

### Penelitian dan Pengabdian
_Teks belum diisi._

### Tata Kelola
_Teks belum diisi._

### Kerja Sama
_Teks belum diisi._

## Tujuan

### Lulusan
_Teks belum diisi._

### Tridarma
_Teks belum diisi._

### Tata Kelola
_Teks belum diisi._

### Kolaborasi
_Teks belum diisi._

## Sasaran dan Indikator Capaian

### Lulusan Berdaya Saing
_Daftar indikator belum diisi._

### Lulusan Inovatif
_Daftar indikator belum diisi._

### Lulusan Adaptif
_Daftar indikator belum diisi._

### Lulusan Berorientasi pada Keberlanjutan
_Daftar indikator belum diisi._

## Nilai-Nilai FEB

- Kreatif dan Inovatif
- Integritas
- Tanggung Jawab
- Amanah
MD;

        $page->save();
    }
}