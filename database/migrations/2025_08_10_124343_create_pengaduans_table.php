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
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('kategori_id')->constrained('kategoris');
            $table->string('judul');
            $table->text('isi_laporan');
            $table->string('foto_kejadian')->nullable();
            $table->enum('status', ['menunggu', 'penanganan', 'selesai', 'ditolak'])->default('menunggu');
            $table->boolean('is_anonymous')->default(false); // Kolom baru untuk status anonim
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
