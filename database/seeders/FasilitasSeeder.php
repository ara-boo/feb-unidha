<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::where('slug', 'fasilitas')->first();

        // Hanya mengisi halaman yang masih berisi penanda, supaya hasil edit admin tidak tertimpa.
        if (! $page || ! str_contains((string) $page->content, 'belum diisi')) {
            return;
        }

        $page->update([
            'content' => <<<'MD'
## Gambaran Fasilitas

Fakultas Ekonomi dan Bisnis menyediakan sarana belajar yang mendukung pembelajaran teori dan praktik, mulai dari ruang kelas dan laboratorium hingga unit pendukung untuk latihan kerja nyata.

- 20 | Ruang kelas
- 3 | Laboratorium komputer

Data jumlah bersumber dari dokumen Renstra FEB 2021–2025.

## Laboratorium dan Sarana Praktik

### Laboratorium Komputer
Tiga laboratorium untuk kegiatan praktik berbasis komputer.

### Laboratorium Vokasi
Sarana pembelajaran praktik program vokasi, juga dipakai untuk kegiatan workshop dosen industri di Gedung C Lantai II.

### Laboratorium Bank Syariah (Tefa DAL)
Teaching factory lembaga keuangan syariah untuk praktik dan magang mahasiswa.

### Galeri Investasi BEI (GISBEI)
Sarana belajar investasi dan pasar modal bagi mahasiswa.

### Tax Center
Wadah edukasi dan pelatihan perpajakan serta kegiatan relawan pajak.

## Ruang Kelas

Ruang kelas tersedia untuk seluruh program studi. Menurut informasi program studi S1 Akuntansi, ruang kelasnya berpendingin udara dan dilengkapi TV.

## Lokasi Kampus

- Alamat: Jl. Sawahan No. 103 A, Simpang Haru, Padang Timur, Kota Padang
- Telepon: 0751-37135
MD,
        ]);
    }
}