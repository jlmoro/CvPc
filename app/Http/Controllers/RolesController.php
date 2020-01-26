<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Roles;

class RolesController extends Controller
{
    public function crear_rol(Request $request)
    {
        try {
            return DB::transaction(function() use($request){

                Roles::create($request->all());

                return[
                    'mensaje'=>'Rol creado correctamente'
                ];

            },5);
        } catch (\Exception $e) {
            return $this->captura_error($e);
        }
    }

    public function editar_rol(Request $request)
    {
        try {
            return DB::transaction(function() use($request){

                

            },3);
        } catch (\Exception $e) {
            return $this->captura_error($e);
        }

    }
    public function eliminar_rol($id_rol)
    {
        try {
            return DB::transaction(function() use($id_rol){

            },3);
        } catch (\Exception $e) {
            return $this->captura_error($e);
        }

    }
}
