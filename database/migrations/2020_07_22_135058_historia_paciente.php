<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistoriaPaciente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_paciente', function (Blueprint $table) {
            $table->bigIncrements('id_datpac');
            $table->string('dp_nombre1', 80);
            $table->string('dp_nombre2', 80)->nullable();
            $table->string('dp_apellido1', 80);
            $table->string('dp_apellido2', 80)->nullable();
            $table->date('dp_fechanace');
            $table->string('dp_estrato', 2)->nullable();
            $table->integer('dp_escolaridad')->nullable();
            $table->integer('dp_etnia')->nullable();
            $table->string('dp_email', 100)->nullable();
            $table->string('dp_telefono', 20)->nullable();
            $table->string('dp_celular', 20)->nullable();
            $table->string('dp_gestante', 1)->nullable();
            $table->string('dp_semgesta', 3)->nullable();
            $table->string('dp_lactante', 1)->nullable();
            $table->string('dp_tielacta', 3)->nullable();
            $table->string('dp_neonato', 1)->nullable();
            $table->string('dp_semnace', 3)->nullable();
            $table->string('dp_pesonace', 6)->nullable();            
            // $table->string('email', 30);
            // $table->string('usuario_telf',20);
            // $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_paciente');
    }
}
