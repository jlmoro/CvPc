<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolucionesPosibles extends Model
{
    protected $table = "soluciones_posibles";
    protected $primarykey = "id";
    protected $guarded = ['tipo_evento','descripcion_evento'];
}
