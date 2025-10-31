<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kol_favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('kol_id')->constrained('kols')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'kol_id']); // mỗi user chỉ favorite 1 KOL 1 lần
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kol_favorites');
    }
};
