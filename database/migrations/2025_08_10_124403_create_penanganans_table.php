<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penanganans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->constrained('pengaduans')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tindaklanjut_id')->constrained('tindaklanjuts');
            $table->text('isi_penanganan');
            $table->string('foto_penanganan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penanganans');
    }
};
