<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\{
    Areas,
    Roles
};

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
            return $this->captura_error($e,'Error al crear area');
        }

    }
    public function listar_areas()
    {
        try {

            $areas = Areas::select('id','area')->get();
            foreach ($areas as $key => $value) {
                $value->roles = Roles::select('id','nombre_rol')->where('id_area',$value->id)->get();
            }
            return $areas;

        } catch (\Exception $e) {
            return $this->captura_error($e,"Error al listar las áreas");
        }

    }
}
