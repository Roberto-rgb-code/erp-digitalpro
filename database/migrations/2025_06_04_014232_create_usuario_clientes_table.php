<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioClientesTable extends Migration
{
    public function up()
    {
        Schema::create('usuario_clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poliza_servicio_id')->constrained('poliza_servicios')->onDelete('cascade');
            $table->string('nombre_usuario');
            $table->string('rol')->nullable(); // Admin, usuario, soporte, etc.
            $table->string('usuario_acceso')->nullable();
            $table->string('password_acceso')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario_clientes');
    }
}
