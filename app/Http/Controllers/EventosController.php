<?php

namespace App\Http\Controllers;

use DB,Validator;
use Illuminate\Http\Request;
use App\Models\{
  Eventos
};

class EventosController extends Controller
{
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
  public function listar_eventos()
  {
    try {

      // return Eventos::select('*')->orderBy('created_at','DESC')->get();
      return DB::select($this->ejecutar_sql("listar_eventos"));

    } catch (\Exception $e) {
      return $this->captura_error($e,'error al listar los eventos');
    }

  }
}
