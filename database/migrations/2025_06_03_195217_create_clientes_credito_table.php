<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesCreditoTable extends Migration
{
    public function up()
    {
        Schema::create('clientes_credito', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->boolean('tiene_linea')->default(false);
            $table->decimal('limite_credito', 12, 2)->nullable();
            $table->integer('dias_credito')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes_credito');
    }
}
