<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Models\Areas;

class AreasController extends Controller
{
    public function crear_area(Request $request)
    {
        try {
            return DB::transaction(function() use($request){

                Areas::create($request->all());

                return[
                    'mensaje'=>'Se ha creado correctamente' //pendiente configuracion mensajes globales
                ];

            },5);
        } catch (\Exception $e) {

        }

    }
}
