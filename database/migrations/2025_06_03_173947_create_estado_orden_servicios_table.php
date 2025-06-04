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
    Schema::create('estados_orden_servicio', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('color')->nullable(); // Para UI (ej: "amarillo", "azul oscuro")
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_orden_servicios');
    }
};
