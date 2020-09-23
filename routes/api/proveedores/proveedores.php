<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('proveedores')->group( function(){
        $controlador = "ProveedoresController";
        Route::post("crear-proveedor","$controlador@crear_proveedor");
        Route::get("listar-proveedores","$controlador@listar_proveedores");
        Route::put("editar-proveedor","$controlador@editar_proveedor");
        Route::delete("{id_proveedor}/eliminar-proveedor","$controlador@eliminar_proveedor");
    });
});
