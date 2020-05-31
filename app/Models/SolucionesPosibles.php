<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolucionesPosibles extends Model
{
    protected $table="soluciones_posibles";
    protected $primary_key="id";
    protected $guarded = ['tipo_evento','nombre_evento_tipo'];
}
