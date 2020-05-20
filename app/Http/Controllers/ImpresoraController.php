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
  public function eliminar_impresoras(Request $request)
  {
    try {
      return DB::transaction(function () use($request){
        dd($request->all());
        $print = Impresora::find($request->id);

        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];

      },3);

    } catch (\Exception $e) {
      return $this->captura_error($e);
    }
  }
  public function crear_impresora(Request $request)
  {
    try {
      return DB::transaction(function () use($request){

        $request['id_encargado'] = $request->encargado;
        $request['id_proveedor'] = $request->proveedor;
        Impresora::create($request->all());
        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];

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
