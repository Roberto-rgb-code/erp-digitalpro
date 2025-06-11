<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('folio')->unique();
            $table->string('nombre');
            $table->unsignedBigInteger('tipo_cliente_id');
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('fecha_alta')->nullable();
            $table->timestamps();

            // Foreign key correcta
            $table->foreign('tipo_cliente_id')->references('id')->on('cliente_tipos')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
