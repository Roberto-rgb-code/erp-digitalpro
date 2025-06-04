<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposClienteTable extends Migration
{
    public function up()
    {
        Schema::create('tipos_cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Usuario final, autoempleado, empresa, etc.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipos_cliente');
    }
}
