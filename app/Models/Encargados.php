<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encargados extends Model
{
    protected $table = 'encargados';
    protected $primaryKey = 'id';
    protected $guarded = ['area','rol'];
}
