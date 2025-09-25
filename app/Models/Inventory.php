<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'kategori', 
        'jumlah',
        'satuan',
        'harga',
        'lokasi',
        'tanggal_masuk',
        'kondisi',
        'kode_barang'
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'harga' => 'decimal:2'
    ];
}
