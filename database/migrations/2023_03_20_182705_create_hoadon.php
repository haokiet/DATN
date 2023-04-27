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
        Schema::create('hoadon', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_nguoidung')->constrained('users')->onDelete('cascade');
            $table->foreignId('ma_vanchuyen')->constrained('vanchuyen')->onDelete('cascade');
            $table->string('dia_chi_nhan',100);
            $table->string('ten_nhan',30);
            $table->integer('trang_thai')->default(0);
            $table->string('so_dt_nhan',11);
            $table->boolean('is_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoadon');
    }
};
