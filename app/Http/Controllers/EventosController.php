<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Eventos
};

class EventosController extends Controller
{
    public function crear_evento(Request $request)
    {
        try {
            return DB::transaction(function() use($request){

                dd($request->all());

            },5);
        } catch (\Exception $e) {

        }
    }
}
