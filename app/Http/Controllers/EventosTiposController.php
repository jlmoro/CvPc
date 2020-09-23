<?php

namespace App\Http\Controllers;

use DB,Validator;
use Illuminate\Http\Request;
use App\Models\{
  EventosTipos,
  EventosTiposDescripcion,
};

class EventosTiposController extends Controller
{
  public function listar_eventos()
  {
    try {

      $eventosT = EventosTipos::select('id','nombre_tipo','sigla')->get();
      foreach ($eventosT as $key => $value) {
        $value->descripcion = EventosTiposDescripcion::select('id','nombre')
        ->where('id_evento_tipo',$value->id)
        ->get();
      }

      return $eventosT;

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar tipos de eventos");
    }
  }
  public function crear_evento_tipo(Request $request)
  {
    try {
      return DB::transaction(function() use($request){
        EventosTipos::create($request->all());
        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];
      },3);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al crear tipo evento");
    }
  }

  public function editar_evento_tipo(Request $request)
  {
    try {
      return DB::transaction(function() use($request){
        $eventoTipo = EventosTipos::find($request->id);
        $eventoTipo->fill($request->all());
        $eventoTipo->update();
        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];
      },3);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al actualizar tipo evento");
    }
  }
  public function eliminar_evento_tipo($id_tipo_evento)
  {
    try {
      return DB::transaction(function() use($id_tipo_evento){

        $eDescrip = EventosTiposDescripcion::select('id')
        ->where('id_evento_tipo',$id_tipo_evento)
        ->count();

        if ($eDescrip) {
          return[
            'mensaje_error'=>"No es posible eliminar el tipo de evento, porque posee una o mas descripciones."
          ];
        }else{
          $eventoTipo = EventosTipos::find($id_tipo_evento);
          $eventoTipo->delete();
          return[
            'mensaje'=>config('domains.mensajes.eliminado')
          ];
        }
      },3);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al actualizar tipo evento");
    }
  }
}
