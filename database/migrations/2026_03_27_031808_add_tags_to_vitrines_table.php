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
        Schema::table('vitrines', function (Blueprint $table) {
            $table->text('tags')->nullable()->after('cor_primaria');
        });
    }

    public function down(): void
    {
        Schema::table('vitrines', function (Blueprint $table) {
            $table->dropColumn('tags');
        });
    }
};
