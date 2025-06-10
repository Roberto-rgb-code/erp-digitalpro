<?php

// database/migrations/2025_06_05_000001_create_gasto_generals_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastoGeneralsTable extends Migration
{
    public function up()
    {
        Schema::create('gasto_generals', function (Blueprint $table) {
            $table->id();
            $table->string('concepto');
            $table->decimal('monto', 12, 2);
            $table->date('fecha');
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('proveedor_id')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('documento')->nullable(); // Para comprobante PDF/XML
            $table->timestamps();

            // Relaciones
            $table->foreign('categoria_id')->references('id')->on('categoria_gastos')->onDelete('set null');
            $table->foreign('proveedor_id')->references('id')->on('clientes')->onDelete('set null'); // Proveedor como cliente
        });
    }

    public function down()
    {
        Schema::dropIfExists('gasto_generals');
    }
}

