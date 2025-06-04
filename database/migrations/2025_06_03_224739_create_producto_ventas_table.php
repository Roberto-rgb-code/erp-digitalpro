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
    Schema::create('producto_ventas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('venta_id')->constrained('ventas')->onDelete('cascade');
        $table->string('producto'); // o foreignId('producto_id') si tienes catálogo
        $table->integer('cantidad');
        $table->decimal('precio_unitario', 12, 2);
        $table->decimal('subtotal', 12, 2);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_ventas');
    }
};
