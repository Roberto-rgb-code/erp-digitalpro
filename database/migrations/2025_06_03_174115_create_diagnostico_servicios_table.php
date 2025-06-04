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
    Schema::create('diagnosticos_servicio', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('orden_servicio_id');
        $table->text('problema')->nullable();
        $table->text('solucion')->nullable();
        $table->text('observaciones')->nullable();
        $table->timestamps();

        $table->foreign('orden_servicio_id')->references('id')->on('ordenes_servicio');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostico_servicios');
    }
};
