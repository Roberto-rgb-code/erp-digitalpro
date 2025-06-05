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
    Schema::create('gasto_generals', function (Blueprint $table) {
        $table->id();
        $table->string('tipo')->nullable(); // Ejemplo: 'Operativo', 'Servicio', etc.
        $table->foreignId('categoria_id')->constrained('categoria_gastos');
        $table->string('proveedor')->nullable();
        $table->text('descripcion')->nullable();
        $table->decimal('monto', 12, 2);
        $table->date('fecha');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gasto_generals');
    }
};
