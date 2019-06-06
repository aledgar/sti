<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadosTest extends Model
{
    protected $table = "resultados_test";
    protected $primaryKey = "id";
    protected $fillable = ['id_alumno', 'num_pregunta', 'respuesta', 'test', 'correcta'];
    public $timestamps = true;
}
