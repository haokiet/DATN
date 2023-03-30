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
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_nguoidung')->constrained('users')->onDelete('cascade');
            $table->string('anh_sp',50);
            $table->string('ten_sp',50);
            $table->longText('mo_ta');
            $table->integer('so_luong');
            $table->integer('gia_goc');
            $table->integer('khuyen_mai')->nullable()->default(0);
            $table->date('ngay_km')->nullable();
            $table->date('ket_thuc_km')->nullable();
            $table->boolean('trang_thai')->default(0);
            $table->boolean('is_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanpham');
    }
};
