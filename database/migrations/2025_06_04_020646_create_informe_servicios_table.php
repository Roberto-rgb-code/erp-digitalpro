<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformeServiciosTable extends Migration
{
    public function up()
    {
        Schema::create('informe_servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poliza_servicio_id')->constrained('poliza_servicios')->onDelete('cascade');
            $table->integer('servicios_remoto_consumidos')->default(0);
            $table->integer('servicios_domicilio_consumidos')->default(0);
            $table->integer('servicios_remoto_contratados')->default(0);
            $table->integer('servicios_domicilio_contratados')->default(0);
            $table->date('fecha_corte')->nullable();
            $table->text('detalle')->nullable(); // JSON, array o texto plano de cada servicio realizado
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('informe_servicios');
    }
}
