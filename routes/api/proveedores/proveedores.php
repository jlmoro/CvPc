<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('proveedores')->group( function(){
        $controlador = "ProveedoresController";
        Route::post("crear-proveedor","$controlador@crear_proveedor");
        Route::get("listar-proveedores","$controlador@listar_proveedores");
        // Route::put("editar-invitado","$controlador@editar_invitado");
        // Route::delete("{id_invitado}/eliminar-invitado","$controlador@eliminar_invitado");
    });
});
