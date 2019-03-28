<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    protected $table = 'maestros';
    protected $primaryKey = 'id';
    protected $fillable = ['telefono','foto','id_user'];
    public $timestamps = true;
}
