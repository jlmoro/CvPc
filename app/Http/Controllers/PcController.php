<?php

namespace App\Http\Controllers;

use DB,Validator,PDF;
use Illuminate\Http\Request;
use App\Models\{
  Pc,
  Equipo,
  PlacaBase,
  Procesador,
  MemoriaRam,
  PcRam,
  DiscoDuro,
  PcDiscoDuro,
  FuentePoder,
  PcPerifericos,
  EquipoComentarios
};

class PcController extends Controller
{
  /**
   * Registro de equipo con el chasís asignado
   */
  public function registrar_equipo(Request $request)
  {
    try {

      // dd($request->all());
      return DB::transaction(function() use($request){

        $placa_base = PlacaBase::create([
          'marca_placa_base'=> $request->board['marca'],
          'modelo_placa'=> $request->board['modelo'],
          'cantidad_pci'=> $request->board['pci'],
          'cantidad_pci_x'=> $request->board['pcix'],
        ]);

        $procesador = Procesador::create([
          'marca'=>$request->procesador['marca'],
          'modelo_tecnologia'=>$request->procesador['modelo'],
          'nucleos'=>$request->procesador['nucleos'],
          'frecuencia'=>$request->procesador['velocidad']
        ]);

        $ram = MemoriaRam::create([
          'marca'=>$request->ram['marca'],
          'modelo_tecnologia'=>$request->ram['tecnologia'],
          'serial'=>$request->ram['serial'],
          'capacidad'=>$request->ram['capacidad'],
          'frecuencia'=>$request->ram['velocidad'],
        ]);

        $disco = DiscoDuro::create($request->disco);

        $fuente = FuentePoder::create($request->fuente);

        $equipo = Equipo::create([
          'id_chasis'=>$request['chasis'],
          'observaciones'=>$request['observaciones'],
          'id_placa_base'=>$placa_base->id,
          'id_procesador'=>$procesador->id,
          'id_fuente_poder'=>$fuente->id,
          'created_by'=>auth()->user()->id,
          'updated_by'=>auth()->user()->id,
        ]);

        $pc_ram = PcRam::create([
          'id_equipo'=>$equipo['id'],
          'id_memoria_ram'=>$ram['id']
        ]);

        $pc_disco = PcDiscoDuro::create([
          'id_equipo'=>$equipo['id'],
          'id_disco'=>$disco['id']
        ]);

        /**
        * registro de perifericos
        * Array de id's
        */
        $cant = count($request->perifericos);
        $data_perifericos = [];

        for($i=0;$i < $cant;$i++){

          $per = [];
          $per = new PcPerifericos;
          $per['id_equipo']     = $equipo['id'];
          $per['id_periferico'] = $request->perifericos[$i];

          $data_perifericos[$i] = $per;

          $per->save();
        }

      },5);

      return[
        'mensaje'=>config('domains.mensajes.creado')
      ];
      //Hasta aquí registro de perifericos

    } catch (\Exception $e) {
      return $this->captura_error($e,'error al registrar equipo');
    }
  }

  /**
   * descargar pdf's para el listado de chasís
   */
  public function descarga_pdf()
  {
    try {

      $chasis = DB::table('pc')
      ->join('encargados', 'pc.id_encargado', '=', 'encargados.id')
      ->join('proveedores', 'pc.id_proveedor', '=', 'proveedores.id')
      ->select('pc.*', 'encargados.nombre_completo as nombre_ecnargado', 'proveedores.nombre_proveedor')
      ->orderBy('pc.created_at','DESC')
      ->get();

      return PDF::loadView('pdf.listaChasis',compact('chasis'))
        ->setPaper('letter', 'landscape')
        ->download('lista-chasis.pdf');

    } catch (\Exception $e) {
      return $this->captura_error($e,'error al descar pdf');
    }
  }

  /**
   * cambia el estado del chasis así mismo el estado del equipo
   * sin importar si dicho chasís está asignado o no
   */
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

  public function cambiar_estado_equipo(int $id_equipo)
  {
    try {
      return DB::transaction(function() use($id_equipo){

        $equipo = Equipo::find($id_equipo);
        ($equipo->estado == 1)?$equipo->estado = 0 : $equipo->estado = 1;
        $equipo->update();
        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];

      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al cambiar estado equipo");
    }

  }

  public function descarga_pdf_detalles_equipo()
  {
    try {

      dd("descarga pdf detalles equipo");

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al descargar pdf");
    }
  }

  /**
   * Listado de los equipos con el chasís asignado
   */
  public function listar_equipo(Request $request)
  {
    try {

      $equipo = DB::table('equipo')
      ->join('pc','equipo.id_chasis', '=', 'pc.id')
      ->join('proveedores', 'pc.id_proveedor', '=', 'proveedores.id')
      ->join('placa_base','equipo.id_placa_base', '=','placa_base.id')
      ->join('procesador','equipo.id_procesador','=','procesador.id')
      ->join('fuente_poder','equipo.id_fuente_poder','=','fuente_poder.id')
      ->select(
        'equipo.id',
        'equipo.observaciones',
        'equipo.estado',
        'pc.placa as chasis_placa',
        'pc.marca as chasis_marca',
        'pc.serial as chasis_serial',
        'proveedores.nombre_proveedor',
        'placa_base.marca_placa_base as board_marca',
        'placa_base.modelo_placa as board_modelo',
        'placa_base.cantidad_pci as board_pci',
        'placa_base.cantidad_pci_x as board_pcix',
        'procesador.marca as cpu_marca',
        'procesador.modelo_tecnologia as cpu_modelo',
        'procesador.nucleos as cpu_nucleos',
        'procesador.frecuencia as cpu_frecuencia',
        'fuente_poder.marca as fuente_marca',
        'fuente_poder.potencia as fuente_potencia',
        'fuente_poder.alimentador_energia as fuente_alimentador',
        'fuente_poder.modelo as fuente_modelo',
        'fuente_poder.factor_forma as fuente_factor_forma',
        )
      ->orderBy('equipo.created_at','DESC')
      ->paginate($request->perPage);

      foreach ($equipo as $key => $value) {
        $value->cant_comentarios = EquipoComentarios::select('id')->where('id_equipo',$value->id)->count();
      }

      // foreach ($equipo as $key => $value) {
      //   $value->disco_duro = DB::collect(select("SELECT e.id,
      //     ram.marca AS ram_marca,
      //     ram.modelo_tecnologia AS ram_tecnologia,
      //     ram.serial AS ram_serial,
      //     ram.capacidad AS ram_capacidad,
      //     ram.frecuencia AS ram_frecuencia
      //     FROM equipo e
      //     LEFT JOIN pc_ram ON pc_ram.id_equipo = e.id
      //     LEFT JOIN memoria_ram ram ON ram.id = pc_ram.id_memoria_ram
      //     WHERE e.id = ?",$value->id))
      //     ->get();
      // }

      return [
        'paginate'=>[
          'total'=>$equipo->total(),
          'currentPage'=>$equipo->currentPage(),
          'perPage'=>$equipo->perPage(),
          'last_page'=>$equipo->lastPage(),
          'from'=>$equipo->firstItem(),
          'to'=>$equipo->lastPage(),
        ],
        'equipo'=>$equipo
      ];


    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar equipo");
    }
  }

  /**
   * Eliminar chasis
   */
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

  /**
   * listado de chasis
   * recibe parámetros en el request
   * la página y cantidad de datos por página
   */
  public function listar_pc(Request $request)
  {
    try {

      $chasis = DB::table('pc')
      ->join('encargados', 'pc.id_encargado', '=', 'encargados.id')
      ->join('proveedores', 'pc.id_proveedor', '=', 'proveedores.id')
      ->select('pc.*', 'encargados.nombre_completo as nombre_ecnargado', 'proveedores.nombre_proveedor')
      ->orderBy('pc.created_at','DESC')
      ->paginate($request->perPage);

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
