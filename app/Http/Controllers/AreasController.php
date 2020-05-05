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
    public function eliminar_area($id_area)
    {
        try {
            return DB::transaction(function() use($id_area){
                $area = Areas::find($id_area);
                $area->delete();
                return[
                    'mensaje'=>config('domains.mensajes.eliminado')
                ];
            },5);
        } catch (\Exception $e) {
            return $this->captura_error($e,'Error al eliminar area');
        }
    }
    public function editar_area(Request $request)
    {
        try {
            return DB::transaction(function() use($request){
                $area = Areas::find($request->id);
                // dd($area);
                $area->fill($request->all());
                $area->update();
                // Areas::create($request->all());
                return[
                    'mensaje'=>config('domains.mensajes.actualizado')
                ];
            },5);
        } catch (\Exception $e) {
            return $this->captura_error($e,'Error al editar area');
        }
    }
    public function crear_area(Request $request)
    {
        try {
            return DB::transaction(function() use($request){
                Areas::create($request->all());
                return[
                    'mensaje'=>config('domains.mensajes.creado')
                ];
            },5);
        } catch (\Exception $e) {
            return $this->captura_error($e,'Error al crear area');
        }
    }
    public function listar_areas()
    {
        try {

            $areas = Areas::select('id','nombre as area')->get();
            foreach ($areas as $key => $value) {
                $value->roles = Roles::select('id','nombre_rol')->where('id_area',$value->id)->get();
            }
            return $areas;

        } catch (\Exception $e) {
            return $this->captura_error($e,"Error al listar las áreas");
        }

    }
}
