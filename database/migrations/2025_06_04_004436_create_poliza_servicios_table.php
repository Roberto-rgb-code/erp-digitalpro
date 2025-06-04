<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolizaServiciosTable extends Migration
{
    public function up()
    {
        Schema::create('poliza_servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->string('tipo_poliza'); // Básica, Avanzada, Ilimitada, etc.
            $table->integer('servicios_restantes_remoto')->default(0);
            $table->integer('servicios_restantes_domicilio')->default(0);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->boolean('activa')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('poliza_servicios');
    }
}
