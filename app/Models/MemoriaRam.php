<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoriaRam extends Model
{
    protected $table = 'memoria_ram';
    protected $primary_key = 'id';
    protected $guarded = [];


    // public function pcram()
    // {
    //   return $this->hasOne(PcRam::class,'id_memoria_ram','id');
    //   // return $this->belongsToMany(PcRam::class,'id');
    // }
}
