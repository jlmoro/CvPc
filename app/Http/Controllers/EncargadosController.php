<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Validator;
use App\Models\Encargados;

class EncargadosController extends Controller
{
  public function eliminar_encargado($id_encargado)
  {
    try {
      return DB::transaction(function() use($id_encargado){
        $encargado = Encargados::find($id_encargado);
        $encargado->delete();

        return[
          'mensaje'=>config('domains.mensajes.eliminado')
        ];
        
      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al eliminar encargado");
    }

  }
  public function crear_encargado(Request $request)
  {
    try {
      return DB::transaction(function() use($request){
        $foto = $this->guardar_imagen($request->foto,'encargados');
        if($foto['estado'] == true){
          $request['foto'] = $foto['ruta'];
        }else {
          return ['error'=>'Error al guardar la imagen'];
        }
        $request['id_rol'] = $request->rol;

        Encargados::create($request->all());

        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];

      },3);

    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al crear encargado");
    }

  }
  public function listar_encargados()
  {
    try {

      return Encargados::all();

    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al listar encargados");
    }

  }
}
