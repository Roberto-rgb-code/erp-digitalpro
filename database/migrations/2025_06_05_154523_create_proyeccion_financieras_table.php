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
    Schema::create('proyeccion_financieras', function (Blueprint $table) {
        $table->id();
        $table->date('fecha');
        $table->decimal('estimado_flujo', 12, 2);
        $table->text('notas')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyeccion_financieras');
    }
};
