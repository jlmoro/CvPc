<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('usuarios')->group( function(){
        $controlador = "UsuariosController";
        Route::post("crear-usuario","$controlador@crear_usuario");
        Route::get("listar-usuarios","$controlador@listar_usuarios");
        // Route::put("editar-invitado","$controlador@editar_invitado");
        Route::delete("{id_proveedor}/eliminar-proveedor","$controlador@eliminar_proveedor");
    });
});
