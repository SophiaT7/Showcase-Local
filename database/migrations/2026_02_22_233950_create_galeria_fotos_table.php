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
        Schema::create('galeria_fotos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vitrine_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->string('legenda')->nullable();
            $table->integer('ordem')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeria_fotos');
    }
};
