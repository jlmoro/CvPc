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
  public function editar_impresora(Request $request)
  {
    try {
      return DB::transaction(function() use($request){

        dd($request->all());
        $print = Impresoras::find($request->id);
        $print->fill($request->all());
        $print->update();

        return[
          'mensaje'=>config('domains.mensajes.actualizado');
        ];

      },3);
    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al editar impresora");
    }
  }
  public function crear_impresora(Request $request)
  {
    try {
      return DB::transaction(function() use($request){

        $request['id_encargado'] = $request->encargado;
        $request['id_proveedor'] = $request->proveedor;
        Impresora::create($request->all());

        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];

      },3);

    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al crear impresora");
    }

  }

  public function eliminar_impresora(int $id_impresora)
  {
    try {
      return DB::transaction(function () use($id_impresora){

        $print = Impresora::find($id_impresora);
        $print->delete();

        return[
          'mensaje'=>config('domains.mensajes.eliminado')
        ];
      },3);
    }catch (\Exception $e) {
      return $this->captura_error($e,"Error al eliminar impresora");
    }
  }
  public function listar_impresoras()
  {
    try {

      return Impresora::select('*')->orderBy('created_at','DESC')->get();

    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al listar impresoras");
    }

  }
}
