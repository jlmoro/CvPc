<?php

namespace App\Http\Controllers;

use DB,Validator;
use Illuminate\Http\Request;
use App\Models\{
  SolucionesPosibles,
  EventosImpresoras,
  EventosPantallas,
  EventosPc,
  ResolverEventoPantalla,
  ResolverEventoImpresora,
  ResolverEventoPc,
};

class EventosController extends Controller
{
  public function listar_eventos_torres(Request $request)
  {
    try {

      $torre = DB::table('eventos_pc')
      ->select('eventos_pc.id',
      'eventos_pc.created_at',
      'eventos_pc.descripcion',
      'pc.placa as chasis_placa',
      'pc.marca as chasis_marca',
      'eventos_tipos_descripcion.nombre as evento_descripcion',
      'encargados.nombre_completo as encargado_nombre',
      'users.name as usuario_nombre_actualiza',
      'users.lastname as usuario_apellido_actualiza',
      'resolver_evento_pc.estado_evento as evento_estado',
      'resolver_evento_pc.fecha_resolver as evento_fecha_resolver',
      // 'u2.name as persona_nombre_asignado',
      // 'u2.lastname as persona_apellido_asignado',
      'soluciones_posibles.solucion_posible as solucion_ayuda'
      )
      ->join('eventos_tipos_descripcion','eventos_pc.id_detalle_evento','=','eventos_tipos_descripcion.id')
      ->join('pc','eventos_pc.id_pc','=','pc.id')
      ->join('encargados', 'pc.id_encargado', '=', 'encargados.id')
      ->join('roles','encargados.id_rol','=','roles.id')
      ->join('areas','roles.id_area','=','areas.id')
      ->join('users','eventos_pc.updated_by','=','users.id')
      ->join('resolver_evento_pc','resolver_evento_pc.id_evento','=','eventos_pc.id')
      // ->join('users as u2','resolver_evento_pc.id_usuario_resolver','=','u2.id')
      ->join('soluciones_posibles','eventos_pc.id_detalle_evento','=','soluciones_posibles.id_descripcion_evento')
      ->orderBy('eventos_pc.created_at','DESC')
      ->paginate($request->perPage);

      return [
        'paginate'=>[
          'total'=>$torre->total(),
          'currentPage'=>$torre->currentPage(),
          'perPage'=>$torre->perPage(),
          'last_page'=>$torre->lastPage(),
          'from'=>$torre->firstItem(),
          'to'=>$torre->lastPage(),
        ],
        'equipo'=>$torre
      ];

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar eventos torre");
    }

  }
  public function registrar_evento_torre($id_torre, Request $request)
  {
    try {
      return DB::transaction(function() use($id_torre, $request){

        $request['id_pc'] = $id_torre;
        $request['created_by'] = auth()->user()->id;
        $request['updated_by'] = auth()->user()->id;

        $evento = EventosPc::create($request->all());

        ResolverEventoPc::create([
          'id_evento'=>$evento->id,
          'estado_evento'=> 1 ,
        ]);

        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];
      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar evento torre");
    }

  }
  public function eliminar_evento_pantalla($id_evento)
  {
    try {
      $e_p = ResolverEventoPantalla::where('id_evento',$id_evento)->first();
      $e_p->delete();

      $even_pant = EventosPantallas::find($id_evento);
      $even_pant->delete();

      return[
        'mensaje'=>config('domains.mensajes.eliminado')
      ];

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al eliminar evento");
    }
  }

  public function eliminar_evento_impresora($id_evento)
  {
    try {

      return DB::transaction(function() use($id_evento){

        $e_i = ResolverEventoImpresora::where('id_evento',$id_evento)->first();
        $e_i->delete();

        $even_impre = EventosImpresoras::find($id_evento);
        $even_impre->delete();

        return[
          'mensaje'=>config('domains.mensajes.eliminado')
        ];
      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al eliminar evento");
    }
  }

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
        // dd($request->all());
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
