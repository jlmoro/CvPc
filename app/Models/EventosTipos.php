<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventosTipos extends Model
{
    protected $table = 'eventos_tipos';
    protected $primaryKey = 'id';
    protected $guarded = ['descripcion'];
}
