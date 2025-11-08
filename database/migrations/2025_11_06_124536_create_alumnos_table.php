<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('telefono');
            $table->string('correo')->unique();
            $table->date('fecha_nacimiento');
            $table->decimal('nota_media', 4, 2)->nullable();
            $table->text('experiencia')->nullable();
            $table->text('formacion')->nullable();
            $table->text('habilidades')->nullable();
            $table->string('fotografia')->nullable();
            $table->string('pdf_cv')->nullable(); // Para el PDF
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};