<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use Illuminate\Database\Seeder;

class LecturerSeeder extends Seeder
{
    public function run(): void
    {
        $lecturers = [
            ['Alvin Alfian', '1022086802'],
            ['Dedi Julianto', '1030018703'],
            ['Dewi Sartika', '1010108702'],
            ['Dian Hirma', '1019048003'],
            ['Dina Anggraini', '1013098803'],
            ['Eka Mariyanti', '1026038501'],
            ['Febri Rahadi', '1005028403'],
            ['Fiko Farlis', '1022108003'],
            ['Fitrah Mulyani', '1021118801'],
            ['Fitria Rahmi', '0028097501'],
            ['Haryeni', '1002028003'],
            ['Henny Sulistianingsih', '1025036701'],
            ['Heru Aulia Azman', '0009127701'],
            ['Idwar', '1009076301'],
            ['Indrayeni', '1028047701'],
            ['Ingra Sovita', '1004097501'],
            ['Lasti Yossi Hastini', '1011117303'],
            ['Lucy Chairoel', '0030066901'],
            ['Maivalinda', '1015056801'],
            ['Masruri', '1021086901'],
            ['Mellyna Eka Yan Fitri', '1001018404'],
            ['Mohammad Abdilla', '1030118201'],
            ['Murniati', '1010017001'],
            ['Nini', '1014066804'],
            ['Nino Sri Purnama Yanti', '0013017902'],
            ['Nofri Yendra', '1021118402'],
            ['Prima Yulianti', '1014078603'],
            ['Puti Embun Sari', '1001048502'],
            ['Rahmaita', '1018118602'],
            ['Ratnawati Raflis', '1021107401'],
            ['Reni Dahar', '1026128303'],
            ['Riani Sukma Wijaya', '1014058302'],
            ['Rita Srihasnita Rosali Caniago', '1018046701'],
            ['Sari Octavera', '1030108002'],
            ['Siska Lusia Putri', '1022038701'],
            ['Siti Fatma', '1656768669230312'],
            ['Syahril', '0015036703'],
            ['Tri Rachmat Riski', '1012038402'],
            ['Triska Marvidola', '5654769670230302'],
            ['Yeni Del Rosa', '0004016402'],
            ['Yentisna', '1006016701'],
            ['Yesi Elsandra', '0412127403'],
            ['Yofina Mulyati', '1012066301'],
            ['Yulisran B. Putra', '1008076202'],
            ['Yusnaena', '0001066708'],
        ];

        foreach ($lecturers as $i => [$name, $nidn]) {
            Lecturer::updateOrCreate(
                ['nidn' => $nidn],
                [
                    'name' => $name,
                    'position' => 'Dosen',
                    'sort_order' => $i + 1,
                ]
            );
        }
    }
}