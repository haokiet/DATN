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
        Schema::create('ct_theloai', function (Blueprint $table) {
            $table->foreignId('ma_sp')->constrained('sanpham')->onDelete('cascade');
            $table->foreignId('ma_theloai')->constrained('theloai')->onDelete('cascade');
            $table->timestamps();
            $table->primary(['ma_sp','ma_theloai']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ct_theloai');
    }
};
