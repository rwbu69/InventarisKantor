<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->text('deskripsi')->nullable();
            $table->string('kategori');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->decimal('harga', 10, 2)->nullable();
            $table->string('lokasi');
            $table->date('tanggal_masuk');
            $table->string('kondisi')->default('Baik');
            $table->string('kode_barang')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
