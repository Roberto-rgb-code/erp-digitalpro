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
    Schema::create('corte_cajas', function (Blueprint $table) {
        $table->id();
        $table->date('fecha');
        $table->decimal('ingresos', 12, 2)->default(0);
        $table->decimal('egresos', 12, 2)->default(0);
        $table->decimal('total', 12, 2)->default(0);
        $table->text('notas')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corte_cajas');
    }
};
