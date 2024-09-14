<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Barang untuk Penjualan 1
            [
                'detail_id' => 1,
                'penjualan_id' => 1,
                'barang_id' => 1, // Televisi 32 Inch
                'harga' => 3000000, // harga jual
                'jumlah' => 2,
            ],
            [
                'detail_id' => 2,
                'penjualan_id' => 1,
                'barang_id' => 2, // Kulkas 2 Pintu
                'harga' => 3800000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 3,
                'penjualan_id' => 1,
                'barang_id' => 3, // Setrika Listrik
                'harga' => 350000,
                'jumlah' => 3,
            ],
        
            // Barang untuk Penjualan 2
            [
                'detail_id' => 4,
                'penjualan_id' => 2,
                'barang_id' => 4, // Rice Cooker 1.8L
                'harga' => 500000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 5,
                'penjualan_id' => 2,
                'barang_id' => 5, // Vacuum Cleaner
                'harga' => 950000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 6,
                'penjualan_id' => 2,
                'barang_id' => 6, // Kaos Polos
                'harga' => 75000,
                'jumlah' => 1,
            ],
        
            // Barang untuk Penjualan 3
            [
                'detail_id' => 7,
                'penjualan_id' => 3,
                'barang_id' => 7, // Celana Jeans
                'harga' => 200000,
                'jumlah' => 3,
            ],
            [
                'detail_id' => 8,
                'penjualan_id' => 3,
                'barang_id' => 8, // Jaket Denim
                'harga' => 350000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 9,
                'penjualan_id' => 3,
                'barang_id' => 9, // Sepatu Sneakers
                'harga' => 400000,
                'jumlah' => 1,
            ],
        
            // Barang untuk Penjualan 4
            [
                'detail_id' => 10,
                'penjualan_id' => 4,
                'barang_id' => 10, // Kemeja Formal
                'harga' => 250000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 11,
                'penjualan_id' => 4,
                'barang_id' => 11, // Minuman Soda 1L
                'harga' => 12000,
                'jumlah' => 3,
            ],
            [
                'detail_id' => 12,
                'penjualan_id' => 4,
                'barang_id' => 12, // Keripik Kentang
                'harga' => 25000,
                'jumlah' => 2,
            ],
        
            // Barang untuk Penjualan 5
            [
                'detail_id' => 13,
                'penjualan_id' => 5,
                'barang_id' => 13, // Coklat Batang 100gr
                'harga' => 18000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 14,
                'penjualan_id' => 5,
                'barang_id' => 14, // Vitamin C 500mg
                'harga' => 35000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 15,
                'penjualan_id' => 5,
                'barang_id' => 15, // Masker Kesehatan 50 pcs
                'harga' => 75000,
                'jumlah' => 2,
            ],
        
            // Barang untuk Penjualan 6
            [
                'detail_id' => 16,
                'penjualan_id' => 6,
                'barang_id' => 1, // Televisi 32 Inch
                'harga' => 3000000,
                'jumlah' => 3,
            ],
            [
                'detail_id' => 17,
                'penjualan_id' => 6,
                'barang_id' => 2, // Kulkas 2 Pintu
                'harga' => 3800000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 18,
                'penjualan_id' => 6,
                'barang_id' => 3, // Setrika Listrik
                'harga' => 350000,
                'jumlah' => 2,
            ],
        
            // Barang untuk Penjualan 7
            [
                'detail_id' => 19,
                'penjualan_id' => 7,
                'barang_id' => 4, // Rice Cooker 1.8L
                'harga' => 500000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 20,
                'penjualan_id' => 7,
                'barang_id' => 5, // Vacuum Cleaner
                'harga' => 950000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 21,
                'penjualan_id' => 7,
                'barang_id' => 6, // Kaos Polos
                'harga' => 75000,
                'jumlah' => 2,
            ],
        
            // Barang untuk Penjualan 8
            [
                'detail_id' => 22,
                'penjualan_id' => 8,
                'barang_id' => 7, // Celana Jeans
                'harga' => 200000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 23,
                'penjualan_id' => 8,
                'barang_id' => 8, // Jaket Denim
                'harga' => 350000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 24,
                'penjualan_id' => 8,
                'barang_id' => 9, // Sepatu Sneakers
                'harga' => 400000,
                'jumlah' => 2,
            ],
        
            // Barang untuk Penjualan 9
            [
                'detail_id' => 25,
                'penjualan_id' => 9,
                'barang_id' => 10, // Kemeja Formal
                'harga' => 250000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 26,
                'penjualan_id' => 9,
                'barang_id' => 11, // Minuman Soda 1L
                'harga' => 12000,
                'jumlah' => 5,
            ],
            [
                'detail_id' => 27,
                'penjualan_id' => 9,
                'barang_id' => 12, // Keripik Kentang
                'harga' => 25000,
                'jumlah' => 1,
            ],
        
            // Barang untuk Penjualan 10
            [
                'detail_id' => 28,
                'penjualan_id' => 10,
                'barang_id' => 13, // Coklat Batang 100gr
                'harga' => 18000,
                'jumlah' => 3,
            ],
            [
                'detail_id' => 29,
                'penjualan_id' => 10,
                'barang_id' => 14, // Vitamin C 500mg
                'harga' => 35000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 30,
                'penjualan_id' => 10,
                'barang_id' => 15, // Masker Kesehatan 50 pcs
                'harga' => 75000,
                'jumlah' => 1,
            ],
        ];

        DB::table('t_penjualan_detail')->insert($data);
    }
}
