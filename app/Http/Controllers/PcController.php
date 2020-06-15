<?php

namespace App\Http\Controllers;

use DB,Validator;
use Illuminate\Http\Request;
use App\Models\Pc;

class PcController extends Controller
{
  

  public function eliminar_pc($id_pc)
  {
    try {
      return DB::transaction(function() use($id_pc){

        $pc = Pc::find($id_pc);
        $pc->delete();

        return[
          'mensaje'=>config('domains.mensajes.eliminado')
        ];

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"error al eliminar chasis");
    }
  }
  public function registrar_pc(Request $request)
  {
    try {
      return DB::transaction(function() use($request){

        $request['id_encargado'] = $request->encargado;
        $request['id_proveedor'] = $request->proveedor;

        Pc::create($request->all());

        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al registrar pc");
    }
  }
  public function cambiar_estado($id_pc)
  {
    try {
      return DB::transaction(function() use($id_pc){

        $pc = Pc::find($id_pc);
        ($pc->estado == 1) ? $pc->estado = 0 : $pc->estado = 1;
        $pc->update();

        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"error al cambiar estado de la impresora");
    }
  }
  public function listar_pc()
  {
    try {

      return DB::select($this->ejecutar_sql("pc/listar_chasis"));

    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al listar PC's");
    }

  }
}
