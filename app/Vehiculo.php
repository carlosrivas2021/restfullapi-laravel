<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Vehiculo extends Model{
    protected $table = "vehiculos";
    protected $primaryKey = "serie"; //Si tiene un nombre distinto a id
    protected $fillable = array('color','cilindraje','potencia','peso','fabricante_id');
    protected $hidden = ['created_at','updated_at'];
    public function fabricante()
    {
        return $this->belongsTo('App\Fabricante');
    }
}