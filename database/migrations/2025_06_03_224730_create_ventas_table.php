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
    Schema::create('ventas', function (Blueprint $table) {
        $table->id();
        $table->string('folio')->unique();
        $table->foreignId('cliente_id')->constrained('clientes');
        $table->date('fecha_venta');
        $table->foreignId('estado_id')->constrained('estado_ventas');
        $table->decimal('total', 12, 2);
        $table->boolean('facturado')->default(false);
        $table->boolean('pagado')->default(false);
        $table->text('observaciones')->nullable();
        $table->foreignId('usuario_id')->nullable()->constrained('users');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
