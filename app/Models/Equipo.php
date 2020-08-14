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

  public function pcram()
  {
    // return $this->hasOne(PcRam::class,'id_equipo','id');
    // return $this->belongsToMany(PcRam::class,'id','id_equipo');
    // return $this->belongsTo(PcRam::class,'id_equipo','id');
    return $this->hasMany(PcRam::class,'id_equipo','id');
  }

  public function pcdisco()
  {
    // return $this->hasOne(PcRam::class,'id_equipo','id');
    // return $this->belongsToMany(PcRam::class,'id','id_equipo');
    // return $this->belongsTo(PcRam::class,'id_equipo','id');
    return $this->hasMany(PcDiscoDuro::class,'id_equipo','id');
  }

}
