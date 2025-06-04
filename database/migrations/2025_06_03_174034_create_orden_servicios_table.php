<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('ordenes_servicio', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('cliente_id')->nullable();
        $table->string('tipo_cliente')->nullable();
        $table->string('folio')->unique();
        $table->string('imei')->nullable();
        $table->date('fecha_ingreso');
        $table->unsignedBigInteger('estado_id');
        $table->text('descripcion')->nullable();
        $table->timestamps();

        $table->foreign('estado_id')->references('id')->on('estados_orden_servicio');
        // Puedes agregar FK a clientes cuando el módulo esté listo:
        // $table->foreign('cliente_id')->references('id')->on('clientes');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_servicios');
    }
};
