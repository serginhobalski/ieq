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
        Schema::create('devotionals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Para URL amigável
            $table->text('content'); // O texto da mensagem
            $table->string('cover_path')->nullable(); // Imagem de destaque
            $table->date('published_at')->default(now()); // Data de publicação
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Autor
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devotionals');
    }
};
