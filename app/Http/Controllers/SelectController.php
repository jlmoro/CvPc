<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Areas,
    Roles
};

class SelectController extends Controller
{
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

            return Roles::where('id_area',$id_area)
            ->get();

        } catch (\Exception $e) {
            return $this->captura_error($e,"error al listar roles");
        }

    }
}
