<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{

    protected $table = 'grupo';
    protected $primaryKey = 'id';
    protected $fillable = ['grado','grupo','generacion_inicio','generacion_fin','turno','id_institucion','id_carrera','id_maestro'];
    public $timestamps = false;

    public function instiucion(){
        return $this->belongsTo('App\Institucion','id_institucion');
    }

    public function carrera(){
        return $this->belongsTo('App\Carreras','id_carrera','id');
    }

}
