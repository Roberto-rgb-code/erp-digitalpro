<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('tipo_cliente_id')->constrained('tipos_cliente');
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->boolean('requiere_factura')->default(false);
            $table->date('fecha_alta')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
