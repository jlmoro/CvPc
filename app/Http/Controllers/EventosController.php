<?php

namespace App\Http\Controllers;

use DB,Validator;
use Illuminate\Http\Request;
use App\Models\{
  Eventos,
  SolucionesPosibles,
  ResolverEvento,
  EventosImpresoras,
  EventosPantallas,
  EventosPc,
  ResolverEventoPantalla,
  ResolverEventoImpresora,
};

class EventosController extends Controller
{
  public function evento_impresora_resuelto($id_evento)
  {
    try {
      return DB::transaction(function() use($id_evento){
        $evento = ResolverEventoImpresora::where('id_evento',$id_evento)->first();
        ($evento->estado_evento == 2) ? $evento->estado_evento = 3 : $evento->estado_evento = 2;
        $evento->update();

        return [
          'mensaje'=>config('domains.mensajes.actualizado')
        ];

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"error al intentar resolver");
    }
  }
  public function evento_pantalla_resuelto($id_evento)
  {
    try {
      return DB::transaction(function() use($id_evento){
        $evento = ResolverEventoPantalla::where('id_evento',$id_evento)->first();
        ($evento->estado_evento == 2) ? $evento->estado_evento = 3 : $evento->estado_evento = 2;
        $evento->update();

        return [
          'mensaje'=>config('domains.mensajes.actualizado')
        ];

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"error al intentar resolver");
    }
  }
  public function fecha_solucion_evento_impresora(int $id_evento, Request $request)
  {
    try {
      return DB::transaction(function() use($id_evento, $request){

        $str = ResolverEventoImpresora::where('id_evento',$id_evento)->first();
        $request['estado_evento'] = 2;
        $str->fill($request->all());
        $str->update();

        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al asignar fecha solución");
    }
  }
  public function fecha_solucion_evento_pantalla(int $id_evento, Request $request)
  {
    try {
      $str = ResolverEventoPantalla::where('id_evento',$id_evento)->first();
      $request['estado_evento'] = 2;
      $str->fill($request->all());
      $str->update();

      return [
        'mensaje'=>config('domains.mensajes.creado')
      ];

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar fecha solución");
    }

  }
  public function fecha_solucion_evento(int $id_evento, Request $request)
  {
    try {
      return DB::transaction(function() use($id_evento,$request){

        $request['id_evento'] = $id_evento;
        $request['estado_evento'] = 1;
        ResolverEvento::create($request->all());

        return [
          'mensaje'=>config('domains.mensajes.creado')
        ];

      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar fecha solución");
    }
  }

  public function editar_evento_pc(Request $request)
  {
    try {

      return DB::transaction(function() use($request){



        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];
      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar evento");
    }
  }

  public function editar_evento_impresora(Request $request)
  {
    try {

      return DB::transaction(function() use($request){



        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];
      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar evento");
    }
  }

  public function editar_evento_pantalla(Request $request)
  {
    try {

      return DB::transaction(function() use($request){



        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];
      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar evento");
    }
  }

  public function registrar_evento_pc(Request $request)
  {
    try {

      return DB::transaction(function() use($request){



        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];
      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar evento");
    }
  }

  public function registrar_evento_pantalla(int $id_pantalla, Request $request)
  {
    try {
      return DB::transaction(function() use($id_pantalla, $request){

        $request['created_by'] = auth()->user()->id;
        $request['updated_by'] = auth()->user()->id;
        $request['id_pantalla'] = $id_pantalla;

        $evento = EventosPantallas::create($request->all());

        ResolverEventoPantalla::create([
          'id_evento'=>$evento->id,
          'estado_evento'=> 1 ,
        ]);

        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];
      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar evento");
    }
  }

  public function registrar_evento_impresora(int $id_impresora, Request $request)
  {
    try {
      return DB::transaction(function() use($id_impresora,$request){

        $request['created_by'] = auth()->user()->id;
        $request['updated_by'] = auth()->user()->id;
        $request['id_impresora'] = $id_impresora;

        $event = EventosImpresoras::create($request->all());

        ResolverEventoImpresora::create([
          'id_evento'=>$event->id,
          'estado_evento'=>1
        ]);

        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];
      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar evento");
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

  public function listar_eventos_pc()
  {
    try {

      return DB::select($this->ejecutar_sql("eventos/listar_eventos_pc"));

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar los eventos pc");
    }
  }

  public function listar_eventos_pantallas()
  {
    try {

      return DB::select($this->ejecutar_sql("eventos/listar_eventos_pantallas"));

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar los eventos pantallas");
    }
  }

  public function listar_eventos_impresoras()
  {
    try {

      return DB::select($this->ejecutar_sql("eventos/listar_eventos_impresoras"));

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar los eventos impresoras");
    }
  }

  public function listar_eventos()
  {
    try {

      return DB::select($this->ejecutar_sql("eventos/listar_eventos"));

    } catch (\Exception $e) {
      return $this->captura_error($e,'error al listar los eventos');
    }
  }
}
