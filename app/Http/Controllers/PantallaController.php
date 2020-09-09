<?php

namespace App\Http\Controllers;

use DB,Validator,PDF;
use Illuminate\Http\Request;
use App\Models\Pantalla;

class PantallaController extends Controller
{
  public function descarga_pdf_pantallas()
  {
    try {
      $pantallas = DB::table('pantalla')
      ->join('encargados', 'pantalla.id_encargado', '=', 'encargados.id')
      ->join('proveedores', 'pantalla.id_proveedor', '=', 'proveedores.id')
      ->select('pantalla.*','encargados.nombre_completo as nombre_ecnargado','proveedores.nombre_proveedor')
      ->orderBy('pantalla.created_at','DESC')
      ->get();

      return PDF::loadView('pdf.listaPantallas',compact('pantallas'))
      ->setPaper('letter', 'landscape')
      ->download('lista-pantallas.pdf');

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al crear pdf");
    }
  }

  public function editar_pantalla(Request $request)
  {
    try {

      $pantalla = Pantalla::find($request->id);
      $pantalla->fill($request->all());
      $pantalla->update();

      return[
        'mensaje'=>config('domains.mensajes.actualizado')
      ];

    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al actualizar pantalla");
    }

  }
  public function cambiar_estado($id_pantalla)
  {
    try {
      return DB::transaction(function() use($id_pantalla){

        $pantalla = Pantalla::select('id','estado')->where('id',$id_pantalla)->first();

        if ($pantalla->estado == 1) {
          $pantalla->update([
            'estado'=> 0
          ]);
        }else {
          $pantalla->update([
            'estado'=> 1
          ]);
        }

        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al eliminar pantalla");
    }

  }
  public function eliminar_pantalla($id_pantalla)
  {
    try {
      return DB::transaction(function() use($id_pantalla){
        $pantalla = Pantalla::find($id_pantalla);
        $pantalla->delete();

        return[
          'mensaje'=>config('domains.mensajes.eliminado')
        ];

      },3);
    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al eliminar pantalla");
    }
  }
  public function registrar_pantalla(Request $request)
  {
    try {
      return DB::transaction(function() use($request){

        $request['id_proveedor'] = $request->proveedor;
        $request['id_encargado'] = $request->encargado;

        Pantalla::create($request->all());

        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar pantalla");
    }
  }
  public function listar_pantallas(Request $request)
  {
    try {

      // return DB::select($this->ejecutar_sql("listado_pantallas"));

      $pantallas = DB::table('pantalla')
      ->join('encargados', 'pantalla.id_encargado', '=', 'encargados.id')
      ->join('proveedores', 'pantalla.id_proveedor', '=', 'proveedores.id')
      ->select('pantalla.*','encargados.nombre_completo as nombre_encargado','proveedores.nombre_proveedor as proveedor')
      ->orderBy('pantalla.created_at','DESC')
      ->paginate($request->perPage);

      return [
        'paginate'=>[
          'total'=>$pantallas->total(),
          'currentPage'=>$pantallas->currentPage(),
          'perPage'=>$pantallas->perPage(),
          'last_page'=>$pantallas->lastPage(),
          'from'=>$pantallas->firstItem(),
          'to'=>$pantallas->lastPage(),
        ],
        'pantallas'=>$pantallas
      ];

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar pantallas");
    }

  }
}
