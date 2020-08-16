<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PcRam extends Model
{
  protected $table = 'pc_ram';
  protected $primaryKey = 'id';
  protected $guarded = [];


  public function ram()
  {
    // return $this->hasOne(PcRam::class,'id_memoria_ram','id');
    return $this->belongsToMany(MemoriaRam::class,'id_memoria_ram','id');
  }
}
