<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTiposTable extends Migration
{
    public function up()
    {
        Schema::create('cliente_tipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique(); // Usuario final, autoempleado, empresa, etc.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cliente_tipos');
    }
}
