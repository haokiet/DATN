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
        Schema::create('ct_hoadon', function (Blueprint $table) {
            $table->foreignId('ma_hoadon')->constrained('hoadon')->onDelete('cascade');
            $table->foreignId('ma_sp')->constrained('sanpham')->onDelete('cascade');
            $table->integer('so_luong_mua');
            $table->primary(['ma_hoadon','ma_sp']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ct_hoadon');
    }
};
