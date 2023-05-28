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
        Schema::create('pinjaman_barang', function (Blueprint $table) {
            $table->id();
            $table->string("peminjam");
            $table->Datetime("tgl_peminjam");
            $table->integer("id_barang");
            $table->string("nama_barang");
            $table->integer("jml_barang");
            $table->Datetime("tgl_kembali");
            $table->string("kondisi");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjaman_barang');
    }
};
