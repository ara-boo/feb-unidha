<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class ProgramProfileSeeder extends Seeder
{
    public function run(): void
    {
        $this->d3Manajemen();
        $this->s1Manajemen();
        $this->s1Akuntansi();
        $this->d3Akuntansi();
        $this->d4AkuntansiPerpajakan();
        $this->s1BisnisDigital();
        $this->s1Pariwisata();
        $this->s2Manajemen();
        $this->mapLecturers();
    }

    // Data dari situs resmi D3 Manajemen Perusahaan.
    private function d3Manajemen(): void
{
    // Akreditasi diperbarui terpisah dari deskripsi.
    StudyProgram::where('slug', 'd3-manajemen-perusahaan')
        ->update([
            'accreditation' => 'Unggul',
        ]);

    // Deskripsi hanya diisi jika masih NULL.
    StudyProgram::where('slug', 'd3-manajemen-perusahaan')
        ->whereNull('description')
        ->update([
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
- Email: [d3manajemen@unidha.ac.id](mailto:d3manajemen@unidha.ac.id)
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

    // Data dari situs resmi S1 Akuntansi. Akreditasi belum tercantum di beranda.
    private function s1Akuntansi(): void
    {
        StudyProgram::where('slug', 's1-akuntansi')
            ->whereNull('description')
            ->update([
                'description' => <<<'MD'
Program studi yang menyiapkan lulusan akuntansi yang profesional, berintegritas, dan siap menghadapi kebutuhan dunia kerja dan industri, didukung dosen profesional, kurikulum yang relevan, dan lingkungan akademik yang inovatif.

### Prospek karier
- Auditor di kantor akuntan publik, perusahaan swasta, BUMN, maupun instansi pemerintah
- Akuntan yang menyajikan informasi keuangan yang transparan dan akurat
- Konsultan keuangan dan pajak

### Kelebihan
- Tersedia jalur Rekognisi Pembelajaran Lampau (RPL) untuk mengonversi pengalaman kerja atau pendidikan sebelumnya menjadi SKS
- Ruang kelas ber-AC dan dilengkapi TV
- Kegiatan mahasiswa rutin, seperti rangkaian Accounting Week

### Kontak
- Alamat: Jl. Sawahan No. 103, Simpang Haru, Padang Timur, Kota Padang 25000

### Media sosial
- [Instagram prodi](https://www.instagram.com/s1_akuntansi_unidha)
- [TikTok prodi](https://www.tiktok.com/@s1akuntansi.unidha)
- [Instagram himpunan mahasiswa](https://www.instagram.com/himaaksi.unidha)
MD,
            ]);
    }

    // Data dari situs resmi D3 Akuntansi.
    private function d3Akuntansi(): void
    {
        StudyProgram::where('slug', 'd3-akuntansi')
            ->whereNull('description')
            ->update([
                'accreditation' => 'Baik Sekali',
                'description' => <<<'MD'
Program studi vokasi yang menghasilkan lulusan profesional di bidang akuntansi, keuangan, perpajakan, dan pemeriksaan akuntansi, dengan masa studi tiga tahun. Lebih dari 60% pembelajaran berbasis praktik, didukung laboratorium, teaching factory lembaga keuangan syariah, dan praktisi industri.

### Arah pengembangan
- Pendidikan vokasi akuntansi yang sesuai kebutuhan industri, dengan kompetensi pendukung keuangan syariah dan jiwa kewirausahaan
- Penelitian terapan dan pengabdian masyarakat di bidang akuntansi
- Kerja sama dengan pihak eksternal yang saling menguntungkan

### Kontak
- Alamat: Jl. Sawahan No. 103 A, Simpang Haru, Padang
- Telepon: 0751-37135
MD,
            ]);
    }

    // Data dari situs resmi D4 Terapan Akuntansi Perpajakan (situsnya masih dalam penyusunan).
    private function d4AkuntansiPerpajakan(): void
    {
        StudyProgram::where('slug', 'd4-akuntansi-perpajakan')
            ->whereNull('description')
            ->update([
                'description' => <<<'MD'
Program sarjana terapan yang menyiapkan lulusan kompeten dan siap kerja di bidang akuntansi perpajakan, dengan keterampilan praktis yang sesuai kebutuhan industri dan regulasi perpajakan nasional.

### Prospek karier
- Praktisi pajak: akuntan pajak, analis pajak, pemeriksa pajak, dan staf akuntansi pajak
- Praktisi akuntansi: akuntan perusahaan, akuntan pemerintah, dan akuntan lembaga keuangan syariah
- Wirausaha di bidang jasa perpajakan dan akuntansi

### Arah pengembangan
- Pendidikan vokasi, penelitian, dan pengabdian masyarakat di bidang akuntansi perpajakan
- Edukasi, pelatihan, dan konsultasi untuk meningkatkan kesadaran dan kepatuhan pajak
MD,
            ]);
    }

    // Data dari situs resmi S1 Bisnis Digital.
    private function s1BisnisDigital(): void
    {
        StudyProgram::where('slug', 's1-bisnis-digital')
            ->whereNull('description')
            ->update([
                'head_name' => 'Dr. Lasti Yossi Hastini, ST., M.Si',
                'description' => <<<'MD'
Program studi yang membekali mahasiswa dengan penguasaan ekosistem e-commerce, analisis data bisnis, dan pemasaran digital secara terpadu, serta menyiapkan generasi yang menguasai teknologi dan kewirausahaan modern.

### Kelebihan
- Kurikulum berbasis kebutuhan industri
- Proyek bisnis nyata
- Dosen dan praktisi ahli
- Bimbingan karier mahasiswa

### Kontak
- Email: bisnisdigital@unidha.ac.id
- Telepon: 0751-37135
MD,
            ]);
    }

    // Data dari situs resmi S1 Pariwisata.
    private function s1Pariwisata(): void
    {
        StudyProgram::where('slug', 's1-pariwisata')
            ->whereNull('description')
            ->update([
                'head_name' => 'Eka Mariyanti, S.E., M.M., M.Par., Ph.D.',
                'description' => <<<'MD'
Program studi yang berfokus pada pariwisata berkelanjutan dan manajemen destinasi berbasis digital, serta menghubungkan budaya melalui pengelolaan industri perhotelan dan event yang profesional.

### Prospek karier
- Perhotelan, akomodasi, dan MICE, termasuk event organizer dan wedding planner
- Tour and travel: perencana perjalanan, pengelola destinasi, dan pemandu wisata profesional
- Instansi pemerintah dan akademisi, misalnya kementerian pariwisata atau dinas pariwisata daerah

### Kontak
- Alamat: Jl. Sawahan No. 103, Simpang Haru, Padang Timur, Kota Padang 25000
- Email: pariwisata@unidha.ac.id

### Media sosial
- [Instagram prodi](https://www.instagram.com/s1pariwisata_unidha)
- [Instagram himpunan mahasiswa](https://www.instagram.com/himpar.unidha)
MD,
            ]);
    }

    // Data dari situs resmi Magister Manajemen.
    private function s2Manajemen(): void
    {
        StudyProgram::where('slug', 's2-manajemen')
            ->whereNull('description')
            ->update([
                'head_name' => 'Dr. Henny Sulistianingsih, S.E., M.Si',
                'description' => <<<'MD'
Program studi magister yang menyelenggarakan pendidikan lanjutan di bidang manajemen di Fakultas Ekonomi dan Bisnis Universitas Dharma Andalas. Pada 2026, program ini telah menggelar ujian tesis untuk angkatan pertama dan kedua.

### Pimpinan program studi
- Ketua: Dr. Henny Sulistianingsih, S.E., M.Si
- Sekretaris: Dr. Prima Yulianti, S.E., M.M

### Kontak
- Alamat: Jl. Sawahan No. 103 A, Simpang Haru, Padang
- Email: sekre.mm@unidha.ac.id
- Telepon: 0751-37135
MD,
            ]);
    }

    // Pemetaan dosen berdasarkan daftar di situs resmi prodi. Hanya mengisi yang masih kosong.
    private function mapLecturers(): void
    {
        $map = [
            's1-bisnis-digital' => ['1011117303', '1022038701', '1021086901', '1009076301', '1005028403'],
            's1-pariwisata'     => ['1026038501'],
            's2-manajemen'      => ['1025036701', '1014078603'],
        ];

        foreach ($map as $slug => $nidns) {
            $programId = StudyProgram::where('slug', $slug)->value('id');

            if (! $programId) {
                continue;
            }

            Lecturer::whereIn('nidn', $nidns)
                ->whereNull('study_program_id')
                ->update(['study_program_id' => $programId]);
        }

        $roles = [
            '1011117303' => 'Ketua Program Studi',
            '1026038501' => 'Ketua Program Studi',
            '1025036701' => 'Ketua Program Studi',
            '1014078603' => 'Sekretaris Program Studi',
            '0009127701' => 'Dekan',
        ];

        foreach ($roles as $nidn => $role) {
            Lecturer::where('nidn', $nidn)
                ->where('position', 'Dosen')
                ->update(['position' => $role]);
        }
    }
}