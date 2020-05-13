<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\{
  Proveedores,
  ProveedoresComentarios
};

class ProveedoresController extends Controller
{
  public function crear_proveedor(Request $request)
  {
    try {
      return DB::transaction(function() use($request){

        $logo = $this->guardar_imagen($request->logo,'proveedores');
        if($logo['estado'] == true){
          $request['logo'] = $logo['ruta'];
        }else {
          return 'Error al guardar imagen';
        }
        Proveedores::create($request->all());
        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e);
    }
  }
  public function listar_proveedores()
  {
    try {

      return Proveedores::all();

    } catch (\Exception $e) {
      return $this->captura_error($e);
    }

  }
}
