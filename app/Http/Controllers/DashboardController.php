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


    } catch (\Exception $e) {
      return $this->captura_error("Problemas al listar eventos calendario");
    }
  }
  public function listar_eventos()
  {
    try {

      return DB::select($this->ejecutar_sql("dashboard/listar_eventos"));
      
      // $eventos_impresora = EventosImpresoras::select('id')->count();
      // $eventos_pantallas = EventosPantallas::select('id')->count();
      // $eventos_pc = EventosPc::select('id')->count();
      //
      // return[
      //   'cant_even_imp' => $eventos_impresora,
      //   'cant_even_pant' =>$eventos_pantallas,
      //   'cant_even_pc' =>$eventos_pc
      // ];

    } catch (\Exception $e) {
      return $this->captura_error($e,"error al listar eventos");
    }
  }
}
