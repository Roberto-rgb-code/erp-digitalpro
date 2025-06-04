<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketSoportesTable extends Migration
{
    public function up()
    {
        Schema::create('ticket_soportes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poliza_servicio_id')->constrained('poliza_servicios')->onDelete('cascade');
            $table->string('folio')->unique();
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('estado')->default('Pendiente'); // Pendiente, En proceso, Resuelto, Cerrado
            $table->unsignedBigInteger('tecnico_id')->nullable(); // usuario responsable (puedes crear tabla de usuarios o usar users)
            $table->string('prioridad')->default('Normal'); // Baja, Normal, Alta
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticket_soportes');
    }
}
