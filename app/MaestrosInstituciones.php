<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaestrosInstituciones extends Model
{
    protected $table = 'maestros_instituciones';
    protected $primaryKey = 'id';
    protected $attributes = ['id_maestro','id_institucion','deleted'];
    public $timestamps = false;

    public function maestros(){
        return $this->belongsTo('App\Maestro','id_maestro');
    }

    public function instituciones(){
        return $this->belongsTo('App\Institucion','id_institucion');
    }

}
