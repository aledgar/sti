<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->boolean('deleted')->default(0);
            $table->timestamps();
        });

        Schema::create('pregunta', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('pregunta');
            $table->bigInteger('id_test')->unsigned();
            $table->foreign('id_test')->references('id')->on('test')->onDelete('cascade');
            $table->boolean('deleted')->default(0);
            $table->timestamps();
        });

        Schema::create('resultado',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('respuesta');
            $table->bigInteger('id_pregunta')->unsigned();
            $table->foreign('id_pregunta')->references('id')->on('pregunta')->onDelete('cascade');
            $table->bigInteger('id_alumno')->unsigned();
            $table->foreign('id_alumno')->references('id')->on('alumno')->onDelete('cascade');
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
        Schema::dropIfExists('tests');
    }
}
