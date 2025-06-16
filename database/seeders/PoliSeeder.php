<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poli;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = [
            [
                'nama_poli' => 'Gigi',
                'deskripsi' => 'Poli gigi adalah bagian dari fasilitas kesehatan yang fokus pada perawatan dan kesehatan gigi serta mulut.'
            ],
            [
                'nama_poli' => 'Anak',
                'deskripsi' => 'Poli anak adalah layanan kesehatan yang khusus menangani masalah kesehatan anak-anak, mulai dari bayi hingga remaja.'
            ],
            [
                'nama_poli' => 'Penyakit Dalam',
                'deskripsi' => 'Menangani berbagai masalah kesehatan organ dalam tubuh manusia, seperti jantung, paru-paru, lambung, usus, hati, dan ginjal.'
            ],
            [
                'nama_poli' => 'Umum',
                'deskripsi' => 'Memberikan layanan pemeriksaan dan pengobatan dasar untuk semua kalangan.'
            ],
            [
                'nama_poli' => 'Mata',
                'deskripsi' => 'Poli mata menyediakan layanan untuk pemeriksaan, diagnosa, dan pengobatan gangguan penglihatan dan kesehatan mata.'
            ],
            [
                'nama_poli' => 'THT',
                'deskripsi' => 'Poli THT melayani masalah kesehatan telinga, hidung, dan tenggorokan.'
            ],
            [
                'nama_poli' => 'Kulit dan Kelamin',
                'deskripsi' => 'Menangani berbagai gangguan kulit serta penyakit menular seksual.'
            ],
            [
                'nama_poli' => 'Kandungan dan Kebidanan',
                'deskripsi' => 'Fokus pada kesehatan ibu hamil, persalinan, serta sistem reproduksi wanita.'
            ],
            [
                'nama_poli' => 'Saraf',
                'deskripsi' => 'Poli saraf menangani gangguan sistem saraf pusat dan tepi, seperti stroke dan epilepsi.'
            ],
            [
                'nama_poli' => 'Jantung',
                'deskripsi' => 'Memberikan layanan kesehatan jantung seperti pemeriksaan EKG, echocardiografi, dan konsultasi kardiologi.'
            ],
        ];

        foreach ($polis as $poli) {
            Poli::create($poli);
        }
    }
}
