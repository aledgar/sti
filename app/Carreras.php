<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    protected $table = 'carrera';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre','deleted'];
    public $timestamps = false;

    public function grupos(){
        return $this->hasMany(Grupo::class);
    }
}
