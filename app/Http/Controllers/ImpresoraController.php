<?php

namespace App\Http\Controllers;

use DB,Validator;
use Illuminate\Http\Request;
use App\Models\{
  Impresora,
  Encargados,
  Proveedores
};

class ImpresoraController extends Controller
{
  public function listar_impresoras()
  {
    try {

      $impresoras = Impresora::all();
      return $impresoras;

    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al listar impresoras");
    }

  }
}
