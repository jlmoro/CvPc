<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\{
  EventosImpresoras,
  EventosPantallas,
  EventosPc
};

class DashboardController extends Controller
{
  public function eventos_calendario()
  {
    try {

      return DB::select($this->ejecutar_sql("dashboard/eventos_calendario"));
      //$eventos_impresoras = DB::select($this->ejecutar_sql("dashboard/eventos_calendario"));
      //$eventos_pantallas = DB::select($this->ejecutar_sql("dashboard/eventos_calendario_2"));
      // $eventos_pc = DB::select($this->ejecutar_sql("dashboard/eventos_calendario_3"));

      /*return[
        'impresoras'=>$eventos_impresoras,
        'pantallas'=>$eventos_pantallas,
        'pc'=>$eventos_pc,
      ];
      */


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
