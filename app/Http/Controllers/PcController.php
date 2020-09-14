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
  public function editar_pc(Request $request)
  {
    try {

      return DB::transaction(function() use($request){

        $chasis = Pc::find($request->id);

        $request['id_encargado'] = $request->id_encargado;
        $request['id_proveedor'] = $request->id_proveedor;

        $chasis->fill($request->all());
        $chasis->update();

        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];

      },3);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al editar pc");
    }

  }
  /**
   * Registro de equipo con el chasís asignado
   */
  public function registrar_equipo(Request $request)
  {
    try {

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

        $fuente = FuentePoder::create($request->fuente);

        $equipo = Equipo::create([
          'id_chasis'=>$request['chasis'],
          'observaciones'=>$request['observaciones'],
          'id_placa_base'=>$placa_base->id,
          'id_procesador'=>$procesador->id,
          'id_fuente_poder'=>$fuente->id,
          'estado'=>$request->estado,
          'created_by'=>auth()->user()->id,
          'updated_by'=>auth()->user()->id,
        ]);

        /**
         * registro de discos en la tabla discoduro y pcdisco
         */
        $cant_disco = count($request->disco);
        $data_discos = [];

        for ($i=0; $i < $cant_disco; $i++) {
          $disco = [];
          $disco = new DiscoDuro;
          $disco['tipo']        =$request->disco[$i]['tipo'];
          $disco['marca']       =$request->disco[$i]['marca'];
          $disco['modelo']      =$request->disco[$i]['modelo'];
          $disco['serial']      =$request->disco[$i]['serial'];
          $disco['rpm']         =$request->disco[$i]['rpm'];
          $disco['capacidad']   =$request->disco[$i]['capacidad'];
          $disco['tecnologia']  =$request->disco[$i]['tecnologia'];

          $data_discos[$i] = $disco;

          $disco->save();
        }

        $data_disco_pc = [];
        for ($i=0; $i < $cant_disco; $i++) {
          $pc_disco = [];
          $pc_disco = new PcDiscoDuro;
          $pc_disco['id_equipo']     = $equipo['id'];
          $pc_disco['id_disco'] = $data_discos[$i]->id;

          $data_disco_pc[$i] = $pc_disco;

          $pc_disco->save();
        }

        /**
         * registro de ram en la tabla memoriaram y pcram
        */

        $cant_ram = count($request->ram);
        $data_ram = [];

        for ($i=0; $i < $cant_ram; $i++) {
          $ram = [];
          $ram = new MemoriaRam;
          $ram['marca']              =$request->ram[$i]['marca'];
          $ram['modelo_tecnologia']  =$request->ram[$i]['tecnologia'];
          $ram['serial']             =$request->ram[$i]['serial'];
          $ram['capacidad']          =$request->ram[$i]['capacidad'];
          $ram['frecuencia']         =$request->ram[$i]['velocidad'];

          $data_ram[$i] = $ram;

          $ram->save();
        }

        $data_ram_pc = [];
        for ($i=0; $i < $cant_ram; $i++) {

          $pc_disco = [];
          $pc_disco = new PcRam;
          $pc_disco['id_equipo']     = $equipo['id'];
          $pc_disco['id_memoria_ram'] = $data_ram[$i]->id;

          $data_ram_pc[$i] = $pc_disco;

          $pc_disco->save();
        }

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

        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];

      },5);

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

  public function eliminando_equipo(int $id_equipo)
  {
    try {
      return DB::transaction(function() use($id_equipo){

        $equipo = Equipo::find($id_equipo);

        DB::table('placa_base')->where('id',$equipo->id_placa_base)->first()->delete();
        // PlacaBase::where('id',$equipo->id_placa_base)->first();

        Procesador::where('id',$equipo->id_procesador)->first()->delete();

        $pcram = PcRam::where('id_equipo',$equipo->id)->get();
        foreach ($pcram as $key => $value) {
          $ram = MemoriaRam::where('id',$value->id_memoria_ram)->get();
          $ram->delete();
        }
        // revisar eliminar equipo con sus foráneas
        $pcram->delete();
        dd($pcdisco);
        $pcdisco = PcDiscoDuro::where('id_equipo',$equipo->id)->get();
        $disco = DiscoDuro::where('id',$pcdisco->id_disco)->get()->delete();
        $pcdisco->delete();
        $fuente = FuentePoder::where('id',$equipo->id_fuente_poder)->first()->delete();
        $peri = PcPerifericos::where('id_equipo',$equipo->id)->get()->delete();
        $comen = EquipoComentarios::where('id_equipo',$equipo->id)->get()->delete();

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

  public function descarga_pdf_detalles_equipo(int $id_equipo)
  {
    try {

      $equipo = Equipo::select(
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
        'encargados.nombre_completo as encargado_nombre',
        'encargados.foto as encargado_foto',
        'encargados.documento as encargado_documento',
        'areas.nombre as area_nombre',
        )
      /*
      ->addSelect(DB::select(DB::raw("SELECT SUM(mr.capacidad) AS suma_ram
      FROM memoria_ram mr
      WHERE mr.id IN ( SELECT pr.id_memoria_ram FROM pc_ram pr WHERE pr.id_equipo = ? )"),[$id_equipo]))
      */

      // ->addSelect(DB::select($this->ejecutar_sql("equipo/lista_ram"),[$id_equipo])->get())
      ->join('pc','equipo.id_chasis', '=', 'pc.id')
      ->join('encargados', 'pc.id_encargado', '=', 'encargados.id')
      ->join('roles','encargados.id_rol','=','roles.id')
      ->join('areas','roles.id_area','=','areas.id')
      ->join('proveedores', 'pc.id_proveedor', '=', 'proveedores.id')
      ->join('placa_base','equipo.id_placa_base', '=','placa_base.id')
      ->join('procesador','equipo.id_procesador','=','procesador.id')
      ->join('fuente_poder','equipo.id_fuente_poder','=','fuente_poder.id')
      ->where('equipo.id',$id_equipo)
      ->first();

      // foreach ($equipo as $key => $value) {
      //
      //   $value->sumaRam = DB::select(DB::raw("SELECT SUM(mr.capacidad) AS suma_ram
      //   FROM memoria_ram mr
      //   WHERE mr.id IN ( SELECT pr.id_memoria_ram FROM pc_ram pr WHERE pr.id_equipo = ? )"),[$value->id]);
      //
      //   $value->sumaDisco = DB::select(DB::raw("SELECT SUM(dd.capacidad) AS suma_disco
      //   FROM disco_duro dd
      //   WHERE dd.id IN ( SELECT pdd.id_disco FROM pc_disco_duro pdd WHERE pdd.id_equipo = ? )"),[$value->id]);
      //
      //   $value->perifericos = DB::select("SELECT pp.id, pp.id_periferico,
      //     ( SELECT pt.nombre FROM perifericos_tipos pt WHERE pt.id = pp.id_periferico )AS periferico_nombre
      //     FROM pc_perifericos pp
      //     WHERE pp.id_equipo = ?",[$value->id]);
      //
      //   $value->disco = DB::select($this->ejecutar_sql("equipo/lista_disco"),[$value->id]);
      //
      //   $value->ram = DB::select($this->ejecutar_sql("equipo/lista_ram"),[$value->id]);
      //
      // }

      // return $equipo;

      // return view('pdf.detallesEquipo',compact('equipo'));

      return PDF::loadView('pdf.detallesEquipo',compact('equipo'))
        // ->setPaper('letter', 'landscape')
        ->download('detalles-equipo.pdf');

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

      // $equipo = DB::table('equipo')
      $equipo = Equipo::select(
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
        'encargados.nombre_completo as encargado_nombre',
        'encargados.foto as encargado_foto',
        'encargados.documento as encargado_documento',
        'areas.nombre as area_nombre',
        )
      ->join('pc','equipo.id_chasis', '=', 'pc.id')
      ->join('encargados', 'pc.id_encargado', '=', 'encargados.id')
      ->join('roles','encargados.id_rol','=','roles.id')
      ->join('areas','roles.id_area','=','areas.id')
      ->join('proveedores', 'pc.id_proveedor', '=', 'proveedores.id')
      ->join('placa_base','equipo.id_placa_base', '=','placa_base.id')
      ->join('procesador','equipo.id_procesador','=','procesador.id')
      ->join('fuente_poder','equipo.id_fuente_poder','=','fuente_poder.id')
      ->orderBy('equipo.created_at','DESC')
      ->paginate($request->perPage);

      foreach ($equipo as $key => $value) {

        $value->sumaRam = DB::select(DB::raw("SELECT SUM(mr.capacidad) AS suma_ram
        FROM memoria_ram mr
        WHERE mr.id IN ( SELECT pr.id_memoria_ram FROM pc_ram pr WHERE pr.id_equipo = ? )"),[$value->id]);

        $value->sumaDisco = DB::select(DB::raw("SELECT SUM(dd.capacidad) AS suma_disco
        FROM disco_duro dd
        WHERE dd.id IN ( SELECT pdd.id_disco FROM pc_disco_duro pdd WHERE pdd.id_equipo = ? )"),[$value->id]);

        $value->perifericos = DB::select("SELECT pp.id, pp.id_periferico,
          ( SELECT pt.nombre FROM perifericos_tipos pt WHERE pt.id = pp.id_periferico )AS periferico_nombre
          FROM pc_perifericos pp
          WHERE pp.id_equipo = ?",[$value->id]);

        $value->disco = DB::select($this->ejecutar_sql("equipo/lista_disco"),[$value->id]);

        $value->ram = DB::select($this->ejecutar_sql("equipo/lista_ram"),[$value->id]);

        $value->cant_comentarios = EquipoComentarios::select('id')->where('id_equipo',$value->id)->count();

      }

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
