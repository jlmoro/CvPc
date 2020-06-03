<?php

namespace App\Http\Controllers;

use DB,Validator;
use Illuminate\Http\Request;
use App\Models\Pantalla;

class PantallaController extends Controller
{
  public function cambiar_estado($id_pantalla)
  {
    try {
      return DB::transaction(function() use($id_pantalla){

        $pantalla = Pantalla::select('id','estado')->where('id',$id_pantalla)->first();

        if ($pantalla->estado == 1) {
          $pantalla->update([
            'estado'=> 0
          ]);
        }else {
          $pantalla->update([
            'estado'=> 1
          ]);
        }

        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al eliminar pantalla");
    }

  }
  public function eliminar_pantalla($id_pantalla)
  {
    try {
      return DB::transaction(function() use($id_pantalla){
        $pantalla = Pantalla::find($id_pantalla);
        $pantalla->delete();

        return[
          'mensaje'=>config('domains.mensajes.eliminado')
        ];

      },3);
    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al eliminar pantalla");
    }
  }
  public function registrar_pantalla(Request $request)
  {
    try {
      return DB::transaction(function() use($request){

        $request['id_proveedor'] = $request->proveedor;
        $request['id_encargado'] = $request->encargado;

        Pantalla::create($request->all());

        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar pantalla");
    }
  }
  public function listar_pantallas()
  {
    try {

      // return Pantalla::all();
      return DB::select($this->ejecutar_sql("listado_pantallas"));

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar pantallas");
    }

  }
}
