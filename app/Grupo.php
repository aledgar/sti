<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{

    protected $table = 'grupo';
    protected $primaryKey = 'id';
    protected $fillable = ['grado','grupo','generacion_inicio','turno','id_institucion'];
    public $timestamps = false;

    public function instiucion(){
        return $this->belongsTo('App\Institucion','id_institucion');
    }

}
