<?php

namespace App\Http\Controllers;

use DB,Validator;
use Illuminate\Http\Request;
use App\Models\Pc;

class PcController extends Controller
{
  public function registrar_pc(Request $request)
  {
    try {
      return DB::transaction(function() use($request){
        dd($request->all());
      },5);
    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al registrar pc");
    }
  }
  public function listar_pc()
  {
    try {

      return Pc::all();

    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al listar PC's");
    }

  }
}
