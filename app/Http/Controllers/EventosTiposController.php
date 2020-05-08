<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Validator;
use App\Models\EventosTipos;

class EventosTiposController extends Controller
{
    public function listar_eventos()
    {
      try {

        return EventosTipos::select('id','nombre_tipo')->get();

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
}
