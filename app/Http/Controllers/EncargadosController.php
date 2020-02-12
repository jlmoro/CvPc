<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Validator;
use App\Models\Encargados;

class EncargadosController extends Controller
{
    public function crear_encargado(Request $request)
    {
        try {
            return DB::transaction(function() use($request){
                dd($request->all());

            },3);

        } catch (\Exception $e) {
            return $this->captura_error($e,"Problema al crear encargado");
        }

    }
    public function listar_encargados()
    {
        try {

            return Encargados::all();

        } catch (\Exception $e) {
            return $this->captura_error($e,"Error al listar encargados");
        }

    }
}
