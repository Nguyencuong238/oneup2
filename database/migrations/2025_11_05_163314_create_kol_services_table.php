<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kol_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kol_id')->constrained('kols')->onDelete('cascade');
            $table->string('name');
            $table->string('image')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kol_services');
    }
};
