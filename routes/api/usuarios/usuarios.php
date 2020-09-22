<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('usuarios')->group( function(){
        $controlador = "UsuariosController";
        Route::post("crear-usuario","$controlador@crear_usuario");
        Route::get("listar-usuarios","$controlador@listar_usuarios");
        Route::put("editar-usuario","$controlador@editar_usuario");
        Route::delete("{id_proveedor}/eliminar-proveedor","$controlador@eliminar_proveedor");

        Route::put("{id_usuario}/estado-usuario","$controlador@estado_usuario");
    });
});
