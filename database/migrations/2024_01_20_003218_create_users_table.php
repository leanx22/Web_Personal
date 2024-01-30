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
        Schema::create('users', function (Blueprint $table) { //crea la tabla users
            $table->id();
            $table->string('name',200);
            $table->string('email')->unique(); //unique, no se puede repetir entre registros.
            $table->timestamp('email_verified_at')->nullable(); //fechas
            $table->string('password');
            $table->rememberToken(); //crea una columna varchar de 100 chars, donde se va a guardar un token para la sesion.
            $table->timestamps(); //created_at updated_at - cuando se modifica/crea el registro.
            
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')->references('id')->on('profiles');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
