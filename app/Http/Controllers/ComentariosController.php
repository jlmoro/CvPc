<?php

namespace App\Http\Controllers;

use DB,Validator;
use Illuminate\Http\Request;
use App\Models\{
  EquipoComentarios,
};

class ComentariosController extends Controller
{
  public function registrar_comentario_equipo(Request $request)
  {
    try {
      return DB::transaction(function() use($request){
        
        dd($request->all());
        $request['created_by'] = auth()->user()->id;

        EquipoComentarios::create($request->all());

        return[
          'mensaje'=>'Se registró comentario correctamente'
        ];
      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,'Error al registrar comentario');
    }
  }
  public function listar_comentarios_equipo(int $id_equipo)
  {
    try {

      return DB::select($this->ejecutar_sql("comentarios/listar_comentarios_equipo",$id_equipo));

    } catch (\Exception $e) {
      return $this->captura_error($e,'Error al registrar comentario');
    }
  }
}
