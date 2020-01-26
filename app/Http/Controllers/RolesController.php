<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Roles;

class RolesController extends Controller
{
    public function crear_rol(Request $request)
    {
        try {

            return DB::transaction(function() use($request){

                Roles::create($request->all());

            },5);

        } catch (\Exception $e) {
            return $this->captura_error($e);
        }

    }
}
