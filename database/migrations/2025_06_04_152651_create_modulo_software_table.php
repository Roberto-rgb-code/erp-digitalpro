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
    Schema::create('modulo_software', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('proyecto_software_id');
        $table->string('nombre_modulo');
        $table->integer('avance')->default(0); // Porcentaje
        $table->enum('estado', ['Planeado', 'En desarrollo', 'Testing', 'Finalizado'])->default('Planeado');
        $table->timestamps();

        $table->foreign('proyecto_software_id')->references('id')->on('proyecto_software')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulo_software');
    }
};
