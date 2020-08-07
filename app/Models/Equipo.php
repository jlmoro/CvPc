<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
  protected $table = 'equipo';
  protected $primary_key = 'id';
  protected $guarded = [];


  // public function placabase()
  // {
  //   return $this->belongsTo('App\Models\PlacaBase','id_placa_base');
  // }

}
