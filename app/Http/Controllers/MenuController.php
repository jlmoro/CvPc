<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function listar_menu()
    {
      try {
        $menuPadre = Menu::select('*')
        ->whereNull('id_padre')
        ->get();
        foreach ($menuPadre as $key => $value) {
          $value->items = Menu::select('*')->where('id_padre',$value->id)->get();
          // dd($value->items);
        }
        return $menuPadre;
      } catch (\Exception $e) {
        return $this->captura_error($e,"error al listar menu principal");
      }
    }
}
