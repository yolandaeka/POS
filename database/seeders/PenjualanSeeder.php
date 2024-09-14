<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Transaksi pada 2024-09-14
            [
                'penjualan_id' => 1,
                'user_id' => 3,
                'pembeli' => 'Budi Santoso',
                'penjualan_kode' => 'PNJ001',
                'penjualan_tanggal' => '2024-09-14 09:00:00',
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 3,
                'pembeli' => 'Andi Wijaya',
                'penjualan_kode' => 'PNJ002',
                'penjualan_tanggal' => '2024-09-14 09:30:00',
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 3,
                'pembeli' => 'Siti Nurhaliza',
                'penjualan_kode' => 'PNJ003',
                'penjualan_tanggal' => '2024-09-14 10:00:00',
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 3,
                'pembeli' => 'Teguh Prasetyo',
                'penjualan_kode' => 'PNJ004',
                'penjualan_tanggal' => '2024-09-14 10:30:00',
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 3,
                'pembeli' => 'Maya Puspita',
                'penjualan_kode' => 'PNJ005',
                'penjualan_tanggal' => '2024-09-14 11:00:00',
            ],
        
            // Transaksi pada 2024-09-15
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'Rahmat Hidayat',
                'penjualan_kode' => 'PNJ006',
                'penjualan_tanggal' => '2024-09-15 09:00:00',
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 3,
                'pembeli' => 'Lina Suryani',
                'penjualan_kode' => 'PNJ007',
                'penjualan_tanggal' => '2024-09-15 09:30:00',
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 3,
                'pembeli' => 'Hendro Wibowo',
                'penjualan_kode' => 'PNJ008',
                'penjualan_tanggal' => '2024-09-15 10:00:00',
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Dewi Sri',
                'penjualan_kode' => 'PNJ009',
                'penjualan_tanggal' => '2024-09-15 10:30:00',
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 3,
                'pembeli' => 'Asep Junaedi',
                'penjualan_kode' => 'PNJ010',
                'penjualan_tanggal' => '2024-09-15 11:00:00',
            ],
        ];

        DB::table('t_penjualan')->insert($data);
        
    }
}
