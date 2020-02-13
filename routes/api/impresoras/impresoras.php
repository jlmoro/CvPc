<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('impresora')->group( function(){
        $controlador = "ImpresoraController";
        Route::post("crear-proveedor","$controlador@crear_proveedor");
        Route::get("listar-impresoras","$controlador@listar_impresoras");
    });
});
