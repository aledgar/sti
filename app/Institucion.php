<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'institucion';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre','deleted'];
    protected $guarded = ['id'];
    public $timestamps = false;

    public function groups(){
        return $this->hasMany('App\Grupo');
    }

}
