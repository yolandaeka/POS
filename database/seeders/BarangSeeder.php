<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Barang dari Supplier 1 (PT. Sumber Makmur)
            [
                'barang_id' => 1,
                'kategori_id' => 1,  // Elektronik
                'barang_kode' => 'BRG001',
                'barang_nama' => 'Televisi 32 Inch',
                'harga_beli' => 2500000,
                'harga_jual' => 3000000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,  // Elektronik
                'barang_kode' => 'BRG002',
                'barang_nama' => 'Kulkas 2 Pintu',
                'harga_beli' => 3200000,
                'harga_jual' => 3800000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 3,  // Peralatan Rumah
                'barang_kode' => 'BRG003',
                'barang_nama' => 'Setrika Listrik',
                'harga_beli' => 250000,
                'harga_jual' => 350000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 3,  // Peralatan Rumah
                'barang_kode' => 'BRG004',
                'barang_nama' => 'Rice Cooker 1.8L',
                'harga_beli' => 400000,
                'harga_jual' => 500000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 3,  // Peralatan Rumah
                'barang_kode' => 'BRG005',
                'barang_nama' => 'Vacuum Cleaner',
                'harga_beli' => 800000,
                'harga_jual' => 950000,
            ],
        
            // Barang dari Supplier 2 (CV. Maju Jaya)
            [
                'barang_id' => 6,
                'kategori_id' => 2,  // Pakaian
                'barang_kode' => 'BRG006',
                'barang_nama' => 'Kaos Polos',
                'harga_beli' => 50000,
                'harga_jual' => 75000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 2,  // Pakaian
                'barang_kode' => 'BRG007',
                'barang_nama' => 'Celana Jeans',
                'harga_beli' => 150000,
                'harga_jual' => 200000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 2,  // Pakaian
                'barang_kode' => 'BRG008',
                'barang_nama' => 'Jaket Denim',
                'harga_beli' => 250000,
                'harga_jual' => 350000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 2,  // Pakaian
                'barang_kode' => 'BRG009',
                'barang_nama' => 'Sepatu Sneakers',
                'harga_beli' => 300000,
                'harga_jual' => 400000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 2,  // Pakaian
                'barang_kode' => 'BRG010',
                'barang_nama' => 'Kemeja Formal',
                'harga_beli' => 180000,
                'harga_jual' => 250000,
            ],
        
            // Barang dari Supplier 3 (Toko Prima Sukses)
            [
                'barang_id' => 11,
                'kategori_id' => 4,  // Makanan & Minuman
                'barang_kode' => 'BRG011',
                'barang_nama' => 'Minuman Soda 1L',
                'harga_beli' => 8000,
                'harga_jual' => 12000,
            ],
            [
                'barang_id' => 12,
                'kategori_id' => 4,  // Makanan & Minuman
                'barang_kode' => 'BRG012',
                'barang_nama' => 'Keripik Kentang',
                'harga_beli' => 15000,
                'harga_jual' => 25000,
            ],
            [
                'barang_id' => 13,
                'kategori_id' => 4,  // Makanan & Minuman
                'barang_kode' => 'BRG013',
                'barang_nama' => 'Coklat Batang 100gr',
                'harga_beli' => 12000,
                'harga_jual' => 18000,
            ],
            [
                'barang_id' => 14,
                'kategori_id' => 5,  // Kesehatan
                'barang_kode' => 'BRG014',
                'barang_nama' => 'Vitamin C 500mg',
                'harga_beli' => 25000,
                'harga_jual' => 35000,
            ],
            [
                'barang_id' => 15,
                'kategori_id' => 5,  // Kesehatan
                'barang_kode' => 'BRG015',
                'barang_nama' => 'Masker Kesehatan 50 pcs',
                'harga_beli' => 50000,
                'harga_jual' => 75000,
            ],
        ];

        DB::table('m_barang')->insert($data);
        
    }
}
