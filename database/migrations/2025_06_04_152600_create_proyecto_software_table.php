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
    Schema::create('proyecto_software', function (Blueprint $table) {
        $table->id();
        $table->string('nombre_proyecto');
        $table->unsignedBigInteger('cliente_id');
        $table->unsignedBigInteger('tipo_software_id');
        $table->string('stack_tecnologico')->nullable(); // Libre o JSON
        $table->date('fecha_inicio')->nullable();
        $table->date('fecha_entrega')->nullable();
        $table->unsignedBigInteger('responsable_id');
        $table->enum('estado', ['Planeado', 'En desarrollo', 'Testing', 'Finalizado'])->default('Planeado');
        $table->text('historial')->nullable();
        $table->timestamps();

        $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        $table->foreign('tipo_software_id')->references('id')->on('tipo_software')->onDelete('cascade');
        $table->foreign('responsable_id')->references('id')->on('empleados')->onDelete('set null');
        $table->unique(['nombre_proyecto', 'cliente_id']); // Único por cliente
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_software');
    }
};
