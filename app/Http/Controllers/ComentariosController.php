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

        EquipoComentarios::create([
          'id_equipo'=>$request->datos['id_equipo'],
          'comentario'=>$request->datos['comentario'],
          'created_by'=>auth()->user()->id
        ]);

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

      return DB::table('equipo_comentarios')
      ->join('equipo', 'equipo_comentarios.id_equipo', '=', 'equipo.id')
      ->join('users', 'equipo_comentarios.created_by', '=', 'users.id')
      ->select('equipo_comentarios.comentario',
      'equipo_comentarios.created_at as fecha_comentario',
      'users.name as usuario_nombre',
      'users.lastname as usuario_apellido',
      'users.foto as usuario_foto',
      )
      ->where('equipo_comentarios.id_equipo',$id_equipo)
      ->orderBy('equipo_comentarios.created_at','DESC')
      ->get();

    } catch (\Exception $e) {
      return $this->captura_error($e,'Error al listar comentarios');
    }
  }
}
