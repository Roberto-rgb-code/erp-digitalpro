<?php

// database/migrations/xxxx_xx_xx_create_tipo_proyectos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoProyectosTable extends Migration
{
    public function up()
{
    Schema::create('tipo_proyectos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->timestamps();
    });
}
    public function down()
    {
        Schema::dropIfExists('tipo_proyectos');
    }
}

