<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encargados extends Model
{
    protected $table = 'encargados';
    protected $guarded = ['area','rol'];
}
