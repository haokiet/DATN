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
        Schema::create('like_binhluan', function (Blueprint $table) {
            $table->foreignId('ma_binhluan')->constrained('binhluan')->onDelete('cascade');
            $table->foreignId('ma_nguoidung')->constrained('users')->onDelete('cascade');
            $table->primary(['ma_binhluan','ma_nguoidung']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('like_binhluan');
    }
};
