<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        $inventories = [
            [
                'kode_barang' => 'PC001',
                'nama_barang' => 'Laptop Dell Latitude 5520',
                'deskripsi' => 'Laptop untuk karyawan IT dengan spesifikasi Intel i7, RAM 16GB, SSD 512GB',
                'kategori' => 'Perangkat Komputer',
                'jumlah' => 5,
                'satuan' => 'Unit',
                'harga' => 15000000,
                'lokasi' => 'Ruang IT Lantai 2',
                'tanggal_masuk' => '2024-01-15',
                'kondisi' => 'Baik',
            ],
            [
                'kode_barang' => 'FUR001',
                'nama_barang' => 'Meja Kantor Executive',
                'deskripsi' => 'Meja kayu jati dengan laci 3 tingkat',
                'kategori' => 'Furniture',
                'jumlah' => 10,
                'satuan' => 'Unit',
                'harga' => 3500000,
                'lokasi' => 'Ruang Manager Lantai 3',
                'tanggal_masuk' => '2024-02-01',
                'kondisi' => 'Baik',
            ],
            [
                'kode_barang' => 'ELK001',
                'nama_barang' => 'Printer Canon G2010',
                'deskripsi' => 'Printer multifungsi dengan sistem tinta refillable',
                'kategori' => 'Elektronik',
                'jumlah' => 3,
                'satuan' => 'Unit',
                'harga' => 2500000,
                'lokasi' => 'Ruang Administrasi Lantai 1',
                'tanggal_masuk' => '2023-12-10',
                'kondisi' => 'Perlu Perbaikan',
            ],
            [
                'kode_barang' => 'ATK001',
                'nama_barang' => 'Kertas A4 80gr',
                'deskripsi' => 'Kertas fotokopi ukuran A4 dengan ketebalan 80 gram',
                'kategori' => 'Alat Tulis',
                'jumlah' => 50,
                'satuan' => 'Pak',
                'harga' => 45000,
                'lokasi' => 'Gudang Lantai 1',
                'tanggal_masuk' => '2024-03-01',
                'kondisi' => 'Baik',
            ],
            [
                'kode_barang' => 'AC001',
                'nama_barang' => 'AC Split 1.5 PK',
                'deskripsi' => 'Air Conditioner split 1.5 PK merk Daikin dengan fitur inverter',
                'kategori' => 'Elektronik',
                'jumlah' => 8,
                'satuan' => 'Unit',
                'harga' => 7500000,
                'lokasi' => 'Seluruh Ruangan Kantor',
                'tanggal_masuk' => '2023-11-15',
                'kondisi' => 'Baik',
            ],
        ];

        foreach ($inventories as $inventory) {
            Inventory::create($inventory);
        }
    }
}