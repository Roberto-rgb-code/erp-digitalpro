<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioClientesTable extends Migration
{
    public function up()
    {
        Schema::create('inventario_clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poliza_servicio_id')->constrained('poliza_servicios')->onDelete('cascade');
            $table->string('nombre_equipo');
            $table->string('tipo_equipo'); // Ej: PC, router, servidor...
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('numero_serie')->nullable();
            $table->string('ip')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventario_clientes');
    }
}
