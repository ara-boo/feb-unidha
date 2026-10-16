<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class ProgramProfileSeeder extends Seeder
{
    public function run(): void
    {
        // Data dari situs resmi D3 Manajemen Perusahaan.
        StudyProgram::where('slug', 'd3-manajemen-perusahaan')
            ->whereNull('description')
            ->update([
                'accreditation' => 'Unggul',
                'description' => <<<'MD'
Program studi vokasi yang menyiapkan lulusan siap kerja di bidang manajemen dan administrasi bisnis, dengan kurikulum yang dekat dengan kebutuhan dunia kerja, pembelajaran berbasis praktik, dan magang industri.

### Prospek karier
- Administrator bisnis
- Supervisor
- Administrasi perbankan
- Marketing officer
- Entrepreneur
- Executive secretary

### Kontak
- Alamat: Jl. Sawahan No. 103 A, Padang
- Email: d3manajemen@unidha.ac.id
- Telepon: 0751-37135
MD,
            ]);
    }
}