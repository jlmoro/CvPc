<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
  Areas,
  Roles,
  Encargados,
  Proveedores,
  EventosTipos,
  Pc,
  Pantalla,
  Impresora,
  Users,
  FuentePoder,
  Procesador,
  MemoriaRam,
  PlacaBase,
  DiscoDuro,
  Equipo,
  PerifericosTipos,
  EventosTiposDescripcion,
};

class SelectController extends Controller
{
  public function listar_perifericos()
  {
    try {

      return PerifericosTipos::select('id','nombre')->get();

    } catch (\Exception $e) {
      return $this->captura_error($e);
    }
  }
  public function listar_disco()
  {
    try {

      return DiscoDuro::select('id','marca','capacidad')->get();

    } catch (\Exception $e) {
      return $this->captura_error($e);
    }
  }
  public function listar_board()
  {
    try {

      return PlacaBase::select('id','marca_placa_base','modelo_placa')->get();

    } catch (\Exception $e) {
      return $this->captura_error($e);
    }
  }
  public function listar_ram()
  {
    try {

      return MemoriaRam::select('id','marca','modelo_tecnologia','capacidad')->get();

    } catch (\Exception $e) {
      return $this->captura_error($e);
    }
  }
  public function listar_procesador()
  {
    try {

      return Procesador::select('id','marca','modelo_tecnologia')->get();

    } catch (\Exception $e) {
      return $this->captura_error($e);
    }
  }
  public function listar_fuentes()
  {
    try {

      return FuentePoder::select('id','marca','potencia')->get();

    } catch (\Exception $e) {
      return $this->captura_error($e);
    }
  }
  public function listar_chasis()
  {
    try {

      return Pc::select('id','placa','marca')
      ->where('estado',1)
      ->orderBy('created_at','DESC')
      ->get();

    } catch (\Exception $e) {
      return $this->captura_error($e);
    }
  }
  public function listar_usuarios()
  {
    try {

      return Users::select('id','name','lastname')
      ->where('estado',1)
      ->get();

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar usuarios");
    }

  }
  public function listar_pc()
  {
    try {
      return Pc::select('id','placa')->orderBy('created_at','DESC')->get();

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar pc");
    }
  }
  public function listar_pantallas()
  {
    try {
      return Pantalla::select('id','placa')->orderBy('created_at','DESC')->get();

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar pantallas");
    }
  }
  public function listar_impresoras()
  {
    try {
      return Impresora::select('id','placa')->orderBy('created_at','DESC')->get();

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar impresoras");
    }
  }
  public function listar_descripcion_eventos($id_evento_tipo)
  {
    try {
      return EventosTiposDescripcion::select('id','nombre')
      ->orderBy('created_at','DESC')
      ->where('id_evento_tipo',$id_evento_tipo)
      ->get();

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar descripción evento");
    }

  }
  public function listar_tipos_eventos()
  {
    try {
      return EventosTipos::select('id','nombre_tipo as nombre','sigla')
      ->orderBy('created_at','DESC')
      ->get();

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar tipos eventos");
    }
  }
  public function listar_proveedores()
  {
    try {
      $proveedor = Proveedores::select('id','nombre_proveedor as nombre')->get();
      return $proveedor;

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar los proveedores");
    }
  }
  public function listar_encargados()
  {
    try {
      $encargados = Encargados::select('id','nombre_completo as nombre')->get();
      return $encargados;

    } catch (\Exception $e) {
      return $this->captura_error($e);
    }
  }
  public function listar_areas()
  {
    try {
      return Areas::all();
    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar areas");
    }
  }

  public function listar_roles($id_area)
  {
    try {

      return Roles::select('id','nombre_rol as rol')
      ->where('id_area',$id_area)
      ->get();

    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al listar los roles");
    }

  }
}
