<?php

namespace App\Http\Controllers;

use DB,Validator;
use Illuminate\Http\Request;
use App\Models\{
    Impresora
};

class ImpresoraController extends Controller
{
    public function listar_impresoras()
    {
        try {

            return Impresora::all();

        } catch (\Exception $e) {
            return $this->captura_error($e,"Error al listar impresoras");
        }

    }
}
