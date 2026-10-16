<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'site_name'     => 'FEB UNIDHA',
            'site_tagline'  => 'Fakultas Ekonomi dan Bisnis',
            'hero_title'    => 'Fakultas Ekonomi dan Bisnis',
            'hero_subtitle' => 'Tempat belajar dan berkembang untuk calon profesional di bidang akuntansi, manajemen, bisnis digital, dan pariwisata.',
            'contact_email' => 'feb@unidha.ac.id',
            'instagram_url' => 'https://www.instagram.com/feb_unidha',
            'pmb_url'       => 'https://pmb.unidha.ac.id/',
        ];

        foreach ($defaults as $key => $value) {
            Setting::firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}