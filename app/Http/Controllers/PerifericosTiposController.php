<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\{
  PerifericosTipos,
};

class PerifericosTiposController extends Controller
{
  public function editar_periferico(Request $request)
  {
    try {

      return DB::transaction(function() use($request){
        $peri = PerifericosTipos::find($request->id);
        $peri->fill($request->all());
        $peri->update();

        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];
      },3);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al actualizar perifericos");
    }

  }
  public function eliminar_periferico(int $id_periferico)
  {
    try {

      return DB::transaction(function() use($id_periferico){
        $periferico = PerifericosTipos::find($id_periferico);
        $periferico->delete();

        return[
          'mensaje'=>config('domains.mensajes.eliminado')
        ];
      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al eliminar periferico");
    }
  }
  public function registrar_periferico(Request $request)
  {
    try {
      return DB::transaction(function() use($request){

        PerifericosTipos::create($request->all());

        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];

      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar periferico");
    }

  }
  public function listar_perifericos()
  {
    try {

      return PerifericosTipos::select('id','nombre')->get();

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar perifericos");
    }
  }
}
