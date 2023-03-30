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
        Schema::create('thanhtoan', function (Blueprint $table) {
            $table->foreignId('ma_hoadon')->constrained('hoadon')->onDelete('cascade');
            $table->foreignId('ma_phuongthuc')->constrained('phuongthuc')->onDelete('cascade');
            $table->integer('tong_tien');
            $table->boolean('trang_thai');
            $table->primary(['ma_hoadon','ma_phuongthuc']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thanhtoan');
    }
};
