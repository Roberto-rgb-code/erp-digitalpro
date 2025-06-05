<?php

// database/migrations/xxxx_xx_xx_create_reporte_actividades_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteActividadesTable extends Migration
{
    public function up()
    {
        Schema::create('reporte_actividades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('proyectos_instalacion');
            $table->foreignId('empleado_id')->constrained('empleados');
            $table->date('fecha');
            $table->text('bitacora');
            $table->string('evidencia')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('reporte_actividades');
    }
}

