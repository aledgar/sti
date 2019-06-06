<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumno';
    protected $fillable = ['foto','id_user','numero_lista','id_grupo','deleted'];
    public $timestamps = true;
    protected $guarded = ['id'];

    public function user(){
        return $this->hasOne('App\User','id','id_user');
    }
}
