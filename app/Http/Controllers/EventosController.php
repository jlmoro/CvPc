<?php

namespace App\Http\Controllers;

use DB,Validator;
use Illuminate\Http\Request;
use App\Models\{
  Eventos,
  SolucionesPosibles,
  ResolverEvento
};

class EventosController extends Controller
{
  public function fecha_solucion_evento(int $id_evento, Request $request)
  {
    try {
      return DB::transaction(function() use($id_evento,$request){

        $request['id_evento'] = $id_evento;
        $request['estado'] = 1;
        ResolverEvento::create($request->all());

        return [
          'mensaje'=>config('domains.mensajes.creado')
        ];

      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar fecha solución");
    }
  }
  public function registrar_evento(Request $request)
  {
    try {
      return DB::transaction(function() use($request){

        $request['id_tipo_evento'] = $request->tipo_evento;
        switch ($request->tipo_dispositivo) {
          case '1':
            $request['id_pc'] = $request->dipositivo;
            break;
          case '2':
            $request['id_pantalla'] = $request->dipositivo;
            break;
          case '3':
            $request['id_impresora'] = $request->dipositivo;
            break;
          default:
            dd('error, revisar');
            break;
        }
        $request['created_by'] = auth()->user()->id;
        $request['updated_by'] = auth()->user()->id;

        Eventos::create($request->all());

        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar evento");
    }
  }
  public function datos_solucion_evento(int $id_evento)
  {
    try {

      $res = SolucionesPosibles::select('id','id_evento_tipo','solucion_posible')
      ->where('id_evento_tipo',$id_evento)
      ->first();

      return $res;

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar solucion evento");
    }

  }
  public function listar_eventos()
  {
    try {

      // return Eventos::select('*')->orderBy('created_at','DESC')->get();
      return DB::select($this->ejecutar_sql("eventos/listar_eventos"));

    } catch (\Exception $e) {
      return $this->captura_error($e,'error al listar los eventos');
    }

  }
}
