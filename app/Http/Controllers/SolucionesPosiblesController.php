<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\{
  SolucionesPosibles,
  EventosTipos
};

class SolucionesPosiblesController extends Controller
{
  public function eliminar_solucion_posible($id_solucion)
  {
    try {

      return DB::transaction(function() use($id_solucion){

        $solucion = SolucionesPosibles::find($id_solucion);
        $solucion->delete();

        return[
          'mensaje'=>config('domains.mensajes.eliminado')
        ];

      },3);
    } catch (\Exception $e) {
      return $this->captura_error($e,"error al eliminar solución posible");
    }

  }
  public function actualizar_solucion_posible(Request $request)
  {
    try {

      return DB::transaction(function() use($request){
        $solucion = SolucionesPosibles::find($request->id);

        $request['id_evento_tipo'] = $request->tipo_evento;
        $solucion->fill($request->all());
        $solucion->update();

        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];

      },3);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al actualizar posible soolucion");
    }

  }
  public function listar_soluciones_posibles()
  {
    try {

      return DB::select("SELECT sp.id,sp.id_evento_tipo,sp.solucion_posible,
        (
          SELECT et.nombre_tipo
          FROM eventos_tipos et
          WHERE et.id = sp.id_evento_tipo
        )AS nombre_evento_tipo
        FROM soluciones_posibles sp");

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar soluciones posibles");
    }
  }
  public function registrar_solucion_posible(Request $request)
  {
    try {
      return DB::transaction(function() use($request){

        $request['id_evento_tipo'] = $request->tipo_evento;
        SolucionesPosibles::create($request->all());

        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];
      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar posible solución");
    }
  }
}
