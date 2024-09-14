<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $data = [
            [
                'supplier_id' => 1,
                'supplier_kode' => 'SUP001',
                'supplier_nama' => 'PT. Sumber Makmur',
                'supplier_alamat' => 'Jl. Melati No. 12, Jakarta',
            ],
            [
                'supplier_id' => 2,
                'supplier_kode' => 'SUP002',
                'supplier_nama' => 'CV. Maju Jaya',
                'supplier_alamat' => 'Jl. Merdeka No. 34, Bandung',
            ],
            [
                'supplier_id' => 3,
                'supplier_kode' => 'SUP003',
                'supplier_nama' => 'Toko Prima Sukses',
                'supplier_alamat' => 'Jl. Anggrek No. 56, Surabaya',
            ],
        ];
        
        DB::table('m_supplier')->insert($data);
    }
}
