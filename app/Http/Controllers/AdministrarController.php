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
            // return Administrar::all();
            return Administrar::select('*')
            ->orderBy('posicion','ASC')
            ->get();

        } catch (\Exception $e) {
            return $this->captura_error($e);
        }
    }
}
