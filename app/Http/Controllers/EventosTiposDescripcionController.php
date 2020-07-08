<?php

namespace App\Http\Controllers;

use DB,Validator;
use Illuminate\Http\Request;
use App\Models\{EventosTiposDescripcion};

class EventosTiposDescripcionController extends Controller
{
    public function crear_evento_descripcion($id_evento_tipo, Request $request)
    {
      try {

        return DB::transaction(function() use($id_evento_tipo,$request){

          dd($request->all());
          
        },5);

      } catch (\Exception $e) {
        return $this->captura_error($e,"error al crear descripción del evento ");
      }

    }
}
