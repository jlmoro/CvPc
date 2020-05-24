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
};

class SelectController extends Controller
{
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
  public function listar_tipos_eventos()
  {
    try {
      return EventosTipos::select('id','nombre_tipo as nombre')->orderBy('created_at','DESC')->get();

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
