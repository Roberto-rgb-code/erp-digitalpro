<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_puesto_empleados_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestoEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::create('puesto_empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del puesto
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('puesto_empleados');
    }
}
