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
        Schema::create('general_stats', function (Blueprint $table) {
            $table->id();
            $table->integer('visitas')->default(0);
            $table->integer('vistas_linkedin')->default(0);
            $table->integer('visitas_github')->default(0);
            $table->integer('interacciones_contacto')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_stats');
    }
};
