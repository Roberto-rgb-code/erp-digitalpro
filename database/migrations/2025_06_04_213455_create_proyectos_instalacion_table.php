<?php

// database/migrations/xxxx_xx_xx_create_proyectos_instalacion_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosInstalacionTable extends Migration

{
    public function up()
    {
        Schema::create('proyectos_instalacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('tipo_proyecto_id')->constrained('tipo_proyectos');
            $table->string('direccion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin_estimada')->nullable();
            $table->foreignId('responsable_id')->constrained('empleados');
            $table->enum('estado', ['Planeado', 'En curso', 'Finalizado'])->default('Planeado');
            $table->unsignedTinyInteger('avance')->default(0); // Porcentaje de avance 0-100
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('proyectos_instalacion');
    }
}
