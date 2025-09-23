<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('nama_pelapor');
            $table->string('email_pelapor');
            $table->string('telepon_pelapor')->nullable();
            $table->string('judul');
            $table->foreignId('kategori_id')->constrained('kategoris');
            $table->string('kategori_lainnya')->nullable();
            $table->foreignId('pendampingan_id')->constrained('pendampingans');
            $table->text('isi_laporan');
            $table->string('foto_kejadian');
            $table->enum('status', ['menunggu', 'penanganan', 'selesai', 'ditolak'])->default('menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
