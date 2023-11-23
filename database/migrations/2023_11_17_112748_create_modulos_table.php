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
        Schema::create('modulos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('materia');
            $table->integer('h_semanales');
            $table->integer('h_totales');
            $table->enum('turno', ['mañana', 'tarde'])->default('mañana');
            $table->string('aula');
            //Foráneas
            $table->integer('user_id')->foreign('user_id')->references('id')->on('users');;
            $table->integer('especialidad_id')->foreign('especialidad_id')->references('id')->on('especialidades');;
            $table->integer('estudio_id')->foreign('estudio_id')->references('id')->on('estudios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulos');
    }
};
