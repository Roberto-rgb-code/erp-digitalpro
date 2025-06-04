<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesFiscalesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes_fiscales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->string('rfc');
            $table->string('razon_social');
            $table->string('uso_cfdi');
            $table->text('direccion_fiscal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes_fiscales');
    }
}
