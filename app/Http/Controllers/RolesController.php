<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Roles;

class RolesController extends Controller
{
  public function crear_rol($id_area, Request $request)
  {
    try {
      return DB::transaction(function() use($request,$id_area){
        $request['nombre_rol'] = $request->rol;
        $request['id_area'] = $id_area;

        Roles::create($request->all());

        return[
          'mensaje'=>config('domains.mensajes.creado')
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

        $rol = Roles::find($request->id);
        $rol->fill($request->all());
        $rol->update();

        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];

      },3);
    } catch (\Exception $e) {
      return $this->captura_error($e,"error al editar rol");
    }

  }
  public function eliminar_rol($id_rol)
  {
    try {
      return DB::transaction(function() use($id_rol){

        $rol = Roles::find($id_rol);
        $rol->delete();

        return[
          'mensaje'=>config('domains.mensajes.eliminado')
        ];

      },3);
    } catch (\Exception $e) {
      return $this->captura_error($e);
    }

  }
}
