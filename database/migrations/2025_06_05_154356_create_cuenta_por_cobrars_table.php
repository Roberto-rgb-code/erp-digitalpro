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
    Schema::create('cuenta_por_cobrars', function (Blueprint $table) {
        $table->id();
        $table->string('cliente');
        $table->decimal('monto', 12, 2);
        $table->date('fecha_vencimiento');
        $table->string('estado')->default('Pendiente');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuenta_por_cobrars');
    }
};
