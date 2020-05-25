<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pantalla extends Model
{
    protected $table = 'pantalla';
    protected $primaryKey = 'id';
    protected $guarded = ['proveedor','encargado'];
}
