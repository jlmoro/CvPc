<?php

namespace App\Http\Controllers;

use DB,Validator;
use Illuminate\Http\Request;
use App\Models\{
  Pc,
  FuentePoder,
  Procesador,
  MemoriaRam,
  PlacaBase,
  DiscoDuro,
  Equipo,
};

class PcController extends Controller
{
  public function cambiar_estado_chasis(int $id_chasis)
  {
    try {
      $chasis = Pc::find($id_chasis);
      ($chasis->estado == 1)?$chasis->estado = 0 : $chasis->estado = 1;
      $chasis->update();
      return[
        'mensaje'=>config('domains.mensajes.actualizado')
      ];

    } catch (\Exception $e) {
      return $this->captura_error($e,'error al cambiar estado chasis');
    }
  }

  public function eliminando_equipo($id_equipo)
  {
    try {
      return DB::transaction(function() use($id_equipo){
        $equipo = Equipo::find($id_equipo);
        $equipo->delete();

        return[
          'mensaje'=>config('domains.mensajes.eliminado')
        ];
      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,'error al eliminar equipo');
    }

  }
  public function registrar_equipo(Request $request)
  {
    try {
      return DB::transaction(function() use($request){

        $placa = Equipo::where('id_chasis',$request->id_chasis)->count();

        if ($placa > 0) {
          return[
            'mensaje2'=>'No es posible asignar ese chasis, pues ya está siendo usado'
          ];
        }else {

          $request['created_by'] = auth()->user()->id;
          $request['updated_by'] = auth()->user()->id;
          Equipo::create($request->all());

          return[
            'mensaje'=>config('domains.mensajes.creado')
          ];
        }

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"error al registrar equipo");
    }
  }

  public function listar_equipo()
  {
    try {

      return DB::select($this->ejecutar_sql("pc/listar_equipo"));

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar equipo");
    }
  }

  public function listar_procesadores()
  {
    try {

        return Procesador::select('*')
        ->orderBy('created_at','DESC')
        ->get();

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar procesador");
    }
  }

  public function registrar_fuente(Request $request)
  {
    try {
      return DB::transaction(function() use($request){
        FuentePoder::create($request->all());
        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];
      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"error en el controller pc");
    }
  }
  public function editar_fuente(Request $request)
  {
    try {
      return DB::transaction(function() use($request){

      $fuente = FuentePoder::find($request->id);
      $fuente->fill($request->all());
      $fuente->update();

      return[
        'mensaje'=>config('domains.mensajes.actualizado')
      ];

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"error en el controller pc");
    }
  }
  public function eliminar_fuente($id_fuente)
  {
    try {
      return DB::transaction(function() use($id_fuente){

        $fuente = FuentePoder::find($id_fuente);
        $fuente->delete();

        return[
          'mensaje'=>config('domains.mensajes.eliminado')
        ];

      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"error en el controller pc");
    }
  }
  public function listar_fuentes()
  {
    try {
        return FuentePoder::select('*')
        ->orderBy('created_at','DESC')
        ->get();

    } catch (\Exception $e) {
      return $this->captura_error($e,"error en el controller pc");
    }
  }

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
      return $this->captura_error($e,"Error al registrar chasís");
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
  public function listar_pc(Request $request)
  {
    try {
      // return DB::select($this->ejecutar_sql("pc/listar_chasis"));
      $chasis = DB::table('pc')
      ->join('encargados', 'pc.id_encargado', '=', 'encargados.id')
      ->join('proveedores', 'pc.id_proveedor', '=', 'proveedores.id')
      ->select('pc.*', 'encargados.nombre_completo as nombre_ecnargado', 'proveedores.nombre_proveedor')
      ->orderBy('pc.created_at','DESC')
      ->paginate($request->perPage);
      // $chasis->withPath('pc/listar/');

      return [
        'paginate'=>[
          'total'=>$chasis->total(),
          'currentPage'=>$chasis->currentPage(),
          'perPage'=>$chasis->perPage(),
          'last_page'=>$chasis->lastPage(),
          'from'=>$chasis->firstItem(),
          'to'=>$chasis->lastPage(),
        ],
        'chasis'=>$chasis
      ];
    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al listar PC's");
    }

  }
}
