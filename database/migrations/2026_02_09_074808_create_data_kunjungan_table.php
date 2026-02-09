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
        Schema::create('data_kunjungan', function (Blueprint $table) {
            $table->id('id_kunjungan');
            $table->foreignId('id_pengunjung')->constrained('data_pengunjung', 'id_pengunjung')->onDelete('cascade');
            $table->text('keperluan');
            $table->dateTime('tanggal_jam_masuk')->nullable();
            $table->dateTime('tanggal_jam_keluar')->nullable();
            $table->integer('durasi_kunjungan')->default(0);
            $table->enum('status', ['IN', 'OUT'])->default('IN');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kunjungan');
    }
};
