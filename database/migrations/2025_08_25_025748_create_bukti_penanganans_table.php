<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bukti_penanganans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penanganan_id')->constrained('penanganans')->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type'); // 'image' atau 'video'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_penanganans');
    }
};
