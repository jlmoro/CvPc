<?php

namespace App\Http\Controllers;

use DB,Validator;
use Illuminate\Http\Request;
use App\Models\{
  Impresora,
  Encargados,
  Proveedores
};

class ImpresoraController extends Controller
{
  public function crear_impresora(Request $request)
  {
    try {
      return DB::transaction(function () use($request){

        dd($request->all());

      },3);
    } catch (\Exception $e) {
      return $this->captura_error($e);
    }
  }
  public function listar_impresoras()
  {
    try {

      $impresoras = Impresora::all();
      return $impresoras;

    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al listar impresoras");
    }

  }
}
