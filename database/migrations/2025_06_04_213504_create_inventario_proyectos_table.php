<?php

// database/migrations/xxxx_xx_xx_create_inventario_proyectos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioProyectosTable extends Migration
{
    public function up()
    {
        Schema::create('inventario_proyectos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('proyectos_instalacion');
            $table->string('material');
            $table->integer('cantidad');
            $table->string('unidad');
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('inventario_proyectos');
    }
}

