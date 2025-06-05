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
    Schema::create('rentabilidads', function (Blueprint $table) {
        $table->id();
        $table->string('linea_negocio')->nullable();
        $table->decimal('ingresos', 12, 2)->default(0);
        $table->decimal('egresos', 12, 2)->default(0);
        $table->decimal('utilidad_neta', 12, 2)->default(0);
        $table->date('fecha')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentabilidads');
    }
};
