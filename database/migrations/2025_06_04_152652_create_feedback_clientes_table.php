<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('feedback_cliente', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('modulo_software_id');
        $table->text('comentario');
        $table->timestamp('fecha')->useCurrent();
        $table->timestamps();

        $table->foreign('modulo_software_id')->references('id')->on('modulo_software')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback_clientes');
    }
};
