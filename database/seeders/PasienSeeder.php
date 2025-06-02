<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pasiens = [
            [
                'nama' => 'Andi Saputra',
                'email' => 'andi.saputra@klinik.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Mangga No. 10, Jakarta Selatan',
                'no_ktp' => '3175062501800006',
                'no_hp' => '081234567895',
                'poli' => null,
            ],
            [
                'nama' => 'Dewi Lestari',
                'email' => 'dewi.lestari@klinik.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Pisang No. 22, Jakarta Barat',
                'no_ktp' => '3175062503810007',
                'no_hp' => '081234567896',
                'poli' => null,
            ],
            [
                'nama' => 'Rudi Hartono',
                'email' => 'rudi.hartono@klinik.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Apel No. 5, Jakarta Timur',
                'no_ktp' => '3175062504820008',
                'no_hp' => '081234567897',
                'poli' => null,
            ],
            [
                'nama' => 'Sari Ayu',
                'email' => 'sari.ayu@klinik.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Duku No. 3, Jakarta Pusat',
                'no_ktp' => '3175062505830009',
                'no_hp' => '081234567898',
                'poli' => null,
            ],
            [
                'nama' => 'Bambang Susilo',
                'email' => 'bambang.susilo@klinik.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Salak No. 15, Jakarta Utara',
                'no_ktp' => '3175062506840010',
                'no_hp' => '081234567899',
                'poli' => null,
            ],
        ];

        $currentYearMonth = date('Ym'); // Contoh: 202506

        foreach ($pasiens as $pasien) {
            // Hitung jumlah pasien dengan no_rm di bulan yang sama
            $patientCount = User::where('no_rm', 'like', $currentYearMonth . '-%')->count();
            $pasien['no_rm'] = $currentYearMonth . '-' . str_pad($patientCount + 1, 3, '0', STR_PAD_LEFT);
            User::create($pasien);
        }
    }
}
