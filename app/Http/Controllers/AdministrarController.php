<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Administrar;

class AdministrarController extends Controller
{
    public function listar_administrar()
    {
        try {

            return Administrar::all();

        } catch (\Exception $e) {
            return $this->captura_error($e);
        }
    }
}
