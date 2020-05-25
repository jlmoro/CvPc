<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
  protected $table = 'eventos';
  protected $primaryKey = 'id';
  protected $guarded = ['tipo_evento','dipositivo'];
}
