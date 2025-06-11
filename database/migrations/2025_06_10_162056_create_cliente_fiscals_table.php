<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cliente_fiscals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->string('rfc');
            $table->string('razon_social');
            $table->foreignId('uso_cfdi_id')->constrained('usos_cfdi');
            $table->string('calle');
            $table->string('numero');
            $table->string('colonia');
            $table->string('cp');
            $table->string('municipio');
            $table->string('estado');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_fiscals');
    }
};
