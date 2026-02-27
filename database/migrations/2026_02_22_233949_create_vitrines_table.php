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
        Schema::create('vitrines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('categoria_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nome');
            $table->string('slug')->unique();
            $table->text('descricao')->nullable();
            $table->string('foto_perfil')->nullable();
            $table->string('banner')->nullable();
            $table->string('whatsapp');
            $table->string('cidade');
            $table->string('bairro')->nullable();
            $table->string('estado', 2);
            $table->string('cor_primaria')->default('#6366f1');
            $table->enum('status', ['pending', 'active', 'rejected'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vitrines');
    }
};
