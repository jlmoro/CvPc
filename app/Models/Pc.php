<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pc extends Model
{
    protected $table = 'pc';
    protected $primaryKey = 'id';
    protected $guarded = [
      'encargado',
      'proveedor'
    ];
}
