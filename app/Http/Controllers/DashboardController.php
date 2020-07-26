<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function eventos_calendario()
  {
    try {

      return DB::select($this->ejecutar_sql("dashboard/eventos_calendario"));

    } catch (\Exception $e) {
      return $this->captura_error("Problemas al listar eventos calendario");
    }
  }
  public function listar_eventos()
  {
    try {

      return DB::select($this->ejecutar_sql("dashboard/listar_eventos"));

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar eventos");
    }
  }
}
