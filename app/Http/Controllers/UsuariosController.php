<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\User;
use App\Models\Roles;

class UsuariosController extends Controller
{
  public function estado_usuario($id_usuario)
  {
    try {

      return DB::transaction(function() use($id_usuario){

        $us = User::find($id_usuario);
        $us_curr = auth()->user()->id;

        if ($us_curr == $id_usuario) {
          return[
            'mensaje2'=>'El usuario actual no puede inactivarse'
          ];
        }

        ($us->estado == 1) ? $us->estado = 0 : $us->estado = 1;

        $us->update();

        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];

      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"error actualizar el estado");
    }

  }
  public function editar_usuario(Request $request)
  {
    try {

      return DB::transaction(function() use($request){

        $user = User::find($request->id);
        // dd($user);

        $foto = $this->guardar_imagen($request->foto,'usuarios');
        if($foto['estado'] == true){
          $request['foto'] = $foto['ruta'];
        }else {
          return 'Error al guardar foto usuario';
        }
        if ($request->password == null) {
          $request['password'] = $user->password;
        }else {
          $request['password'] = bcrypt($request->password);
        }

        $user->fill($request->all());
        $user->update();

        return[
          'mensaje'=>config('domains.mensajes.actualizado')
        ];
      },5);

    } catch (\Exception $e) {
      return $this->captura_error($e,"Error al editar usuario");
    }
  }
  public function crear_usuario(Request $request)
  {
    try {

      return DB::transaction(function() use($request){

        $foto = $this->guardar_imagen($request->foto,'usuarios');
        if($foto['estado'] == true){
          $request['foto'] = $foto['ruta'];
        }else {
          return 'Error al guardar foto usuario';
        }

        $request['password'] = bcrypt($request->password);

        // dd($request->all());

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
