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
    Schema::create('documentos_financieros', function (Blueprint $table) {
        $table->id();
        $table->string('nombre_archivo');
        $table->string('tipo_documento');
        $table->string('proveedor')->nullable();
        $table->foreignId('gasto_general_id')->nullable()->constrained('gasto_generals')->onDelete('set null');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_financieros');
    }
};
