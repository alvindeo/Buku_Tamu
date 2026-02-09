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
        Schema::create('data_pengunjung', function (Blueprint $table) {
            $table->id('id_pengunjung');
            $table->string('no_hp')->unique();
            $table->string('nama');
            $table->string('asal_institusi');
            $table->timestamp('tanggal_jam_masuk')->nullable();
            $table->timestamp('tanggal_jam_keluar')->nullable();
            $table->text('keperluan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pengunjung');
    }
};
