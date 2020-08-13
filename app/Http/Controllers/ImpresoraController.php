<?php

namespace App\Http\Controllers;

use DB,Validator,PDF;
use Illuminate\Http\Request;
use App\Models\{
  Impresora,
  Encargados,
  Proveedores,
  EventosImpresoras,
};

class ImpresoraController extends Controller
{

  public function descarga_pdf_impresoras()
  {
    try {

      $printers = DB::table('impresora')
      ->join('encargados', 'impresora.id_encargado', '=', 'encargados.id')
      ->join('proveedores', 'impresora.id_proveedor', '=', 'proveedores.id')
      ->select('impresora.*','encargados.nombre_completo as nombre_ecnargado','proveedores.nombre_proveedor')
      ->orderBy('impresora.created_at','DESC')
      ->get();

      return PDF::loadView('pdf.listaImpresoras',compact('printers'))
        ->setPaper('letter', 'landscape')
        ->download('lista-impresoras.pdf');

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al crear pdf");
    }

  }

  public function cambiar_estado($id_impresora)
  {
    try {
      return DB::transaction(function() use($id_impresora){
        $printer = Impresora::find($id_impresora);

        ($printer->estado == 1) ? $printer->estado = 0 : $printer->estado = 1;
        $printer->update();

        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"error al cambiar estado de la impresora");
    }
  }
  public function editar_impresora(Request $request)
  {
    try {
      return DB::transaction(function() use($request){

        $print = Impresora::find($request->id);
        $print->fill($request->all());
        $print->update();

        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];

      },3);
    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al editar impresora");
    }
  }
  public function crear_impresora(Request $request)
  {
    try {
      return DB::transaction(function() use($request){

        $request['id_encargado'] = $request->encargado;
        $request['id_proveedor'] = $request->proveedor;
        Impresora::create($request->all());

        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];

      },3);

    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al crear impresora");
    }

  }

  public function eliminar_impresora(int $id_impresora)
  {
    try {
      return DB::transaction(function () use($id_impresora){

        $print = Impresora::find($id_impresora);
        $print->delete();

        return[
          'mensaje'=>config('domains.mensajes.eliminado')
        ];
      },3);
    }catch (\Exception $e) {
      return $this->captura_error($e,"Error al eliminar impresora");
    }
  }
  public function listar_impresoras(Request $request)
  {
    try {

      // return DB::select($this->ejecutar_sql("listado_impresoras"));

      $printers = DB::table('impresora')
      ->join('encargados', 'impresora.id_encargado', '=', 'encargados.id')
      ->join('proveedores', 'impresora.id_proveedor', '=', 'proveedores.id')
      ->select('impresora.*','encargados.nombre_completo as nombre_encargado','proveedores.nombre_proveedor as proveedor')
      ->orderBy('impresora.created_at','DESC')
      ->paginate($request->perPage);

      return [
        'paginate'=>[
          'total'=>$printers->total(),
          'currentPage'=>$printers->currentPage(),
          'perPage'=>$printers->perPage(),
          'last_page'=>$printers->lastPage(),
          'from'=>$printers->firstItem(),
          'to'=>$printers->lastPage(),
        ],
        'impresoras'=>$printers
      ];

    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al listar impresoras");
    }

  }
}
