<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institucion', function (Blueprint $table){
           $table->bigIncrements('id');
           $table->string('nombre');
           $table->boolean('deleted')->default(0);
        });

        Schema::create('Grupo',function (Blueprint $table){
           $table->bigIncrements('id');
            $table->string('grado')->default(1)->nullable();
            $table->string('Grupo');
            $table->date('generacion_inicio');
            $table->date('generacion_fin');
            $table->string('turno')->nullable();
            $table->bigInteger('id_institucion')->unsigned();
            $table->foreign('id_institucion')->references('id')->on('institucion')
                ->onDelete('cascade');
        });

        Schema::create('carrera',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->boolean('deleted')->default(0);
        });

        Schema::create('alumno', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('foto')->nullable();
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->integer('numero_lista')->default(0);
            $table->bigInteger('id_carrera')->unsigned();
            $table->foreign('id_carrera')->references('id')->on('carrera')->onDelete('cascade');
            $table->bigInteger('id_grupo')->unsigned();
            $table->foreign('id_grupo')->references('id')->on('Grupo')->onDelete('cascade');
            $table->boolean('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institucion');
        Schema::dropIfExists('Grupo');
        Schema::dropIfExists('carrera');
        Schema::dropIfExists('alumno');
    }
}
