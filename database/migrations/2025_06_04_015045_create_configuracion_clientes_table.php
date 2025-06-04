<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionClientesTable extends Migration
{
    public function up()
    {
        Schema::create('configuracion_clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poliza_servicio_id')->constrained('poliza_servicios')->onDelete('cascade');
            $table->string('tipo_red')->nullable(); // Ej: LAN, WiFi, VPN, etc.
            $table->string('ip_publica')->nullable();
            $table->string('ip_privada')->nullable();
            $table->string('gateway')->nullable();
            $table->string('dns')->nullable();
            $table->string('software_instalado')->nullable(); // Coma separada, o después puedes hacer tabla aparte
            $table->text('accesos')->nullable(); // Usuario/contraseña de algún sistema, acceso remoto, etc.
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('configuracion_clientes');
    }
}
