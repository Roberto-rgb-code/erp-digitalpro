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
    Schema::create('vehiculos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre')->unique();
        $table->string('marca');
        $table->string('modelo');
        $table->integer('anio');
        $table->string('placas')->unique();
        $table->unsignedBigInteger('responsable_id')->nullable(); // FK empleado
        $table->enum('estado', ['Disponible', 'En uso', 'En servicio'])->default('Disponible');
        $table->integer('kilometraje_actual')->nullable();
        $table->timestamps();

        $table->foreign('responsable_id')->references('id')->on('empleados')->nullOnDelete();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
