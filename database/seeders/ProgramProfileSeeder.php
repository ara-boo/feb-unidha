<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class ProgramProfileSeeder extends Seeder
{
    public function run(): void
    {
        $this->d3Manajemen();
        $this->s1Manajemen();
    }

    // Data dari situs resmi D3 Manajemen Perusahaan.
    private function d3Manajemen(): void
    {
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

    // Data dari situs resmi S1 Manajemen.
    private function s1Manajemen(): void
    {
        StudyProgram::where('slug', 's1-manajemen')
            ->whereNull('description')
            ->update([
                'accreditation' => 'Unggul',
                'description' => <<<'MD'
Program studi yang menyiapkan sarjana manajemen yang inovatif, adaptif, berdaya saing, dan berorientasi pada keberlanjutan, dengan semangat kepemimpinan dan kewirausahaan untuk menghadapi dunia bisnis modern.

### Arah pengembangan
- Pendidikan manajemen yang bermutu dan adaptif
- Penelitian dan pengabdian masyarakat di bidang manajemen dan bisnis
- Tata kelola program studi yang baik
- Kerja sama dengan dunia usaha, pemerintah, dan institusi pendidikan, termasuk peluang magang

### Kontak
- Alamat: Jl. Sawahan No. 103 A, Simpang Haru, Padang Timur, Kota Padang
- Email: s1manajemenunidha@unidha.ac.id
- Telepon: 0751-37135

### Media sosial
- [Instagram](https://www.instagram.com/s1_manajemen_unidha)
- [TikTok](https://www.tiktok.com/@s1manajemen)
MD,
            ]);
    }
}