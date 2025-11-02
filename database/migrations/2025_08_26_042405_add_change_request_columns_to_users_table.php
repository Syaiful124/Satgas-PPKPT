<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('status_perubahan')->nullable()->after('role');
            $table->json('data_perubahan')->nullable()->after('status_perubahan');
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['status_perubahan', 'data_perubahan']);
        });
    }
};
