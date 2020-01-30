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
                
                Proveedores::create($request->all());

                return[
                    'mensaje'=>'Se ha creado el proveedor correctamente'
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
