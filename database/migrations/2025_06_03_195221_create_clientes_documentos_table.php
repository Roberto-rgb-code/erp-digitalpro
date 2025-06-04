<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesDocumentosTable extends Migration
{
    public function up()
    {
        Schema::create('clientes_documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->string('tipo_doc'); // contrato, solicitud, identificación, cheques, etc.
            $table->string('archivo'); // ruta o nombre del archivo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes_documentos');
    }
}
