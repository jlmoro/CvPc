<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\User;
use App\Models\Roles;

class UsuariosController extends Controller
{
  public function crear_usuario(Request $request)
  {
    try {

      return DB::transaction(function() use($request){

        dd($request->all());

        User::create($request->all());

        return[
          'mensaje'=>config('domains.mensajes.creado')
        ];
      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al crear usuarios");
    }

  }
  public function listar_usuarios()
  {
    try {

      return DB::select("SELECT u.id,u.name,u.lastname,u.documento,u.email,u.estado,u.id_rol,u.foto,u.telefono,
        r.nombre_rol AS nombre_rol,
        a.nombre AS nombre_area
        FROM users u
        LEFT JOIN roles r ON u.id_rol = r.id
        LEFT JOIN areas a ON r.id_area = a.id");

      } catch (\Exception $e) {
        return $this->captura_error($e,"Error al listar usuarios");
      }

    }
  }
