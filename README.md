# 🎓 Website Portal FEB UNIDHA (Fakultas Ekonomi dan Bisnis)
Tugas Mata Kuliah Pemrograman Lanjutan

Website profil resmi Fakultas Ekonomi dan Bisnis Universitas Dharma Andalas (UNIDHA) yang dibangun menggunakan framework **Laravel**, **Tailwind CSS**, dan **MySQL**.

---

## ✨ Fitur-Fitur Website

### 1. Halaman Publik (Pengunjung):
* **Beranda:** Banner selamat datang, sambutan dekanat, berita terbaru, dan ringkasan prodi.
* **Program Studi:** Menampilkan jenjang (D3, S1), akreditasi, ketua prodi, dan tautan resmi.
* **Staf Dosen:** Menampilkan 45+ dosen FEB UNIDHA lengkap dengan foto asli, nama, gelar, NIDN, dan jabatan.
* **Berita & Pengumuman:** Informasi magang, beasiswa, ujian komprehensif, dan ujian tesis.

### 2. Dashboard Admin (CMS):
* Manajemen Berita & Pengumuman (CRUD).
* Manajemen Data Dosen & Upload Foto.
* Manajemen Program Studi & Pilihan Akreditasi.
* Manajemen Halaman Profil (Visi, Misi, Struktur Organisasi).

---

## 🚀 Cara Menjalankan di Komputer Lokal

1. **Clone repository ini:**
   ```bash
   git clone https://github.com/ara-boo/feb-unidha.git
   cd feb-unidha
   ```

2. **Install dependency PHP & Node.js:**
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Pengaturan Database:**
   * Salin file `.env.example` menjadi `.env`.
   * Sesuaikan koneksi database MySQL Anda.
   * Jalankan migrasi dan seeder:
     ```bash
     php artisan migrate --seed
     php artisan storage:link
     ```

4. **Jalankan Server:**
   ```bash
   php artisan serve
   ```
   Buka di browser: `http://127.0.0.1:8000`