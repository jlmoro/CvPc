<?php
Route::group(['middleware' =>'auth:api'], function (){
  Route::prefix('impresora')->group( function(){
    $controlador = "ImpresoraController";
    Route::post("crear-impresora","$controlador@crear_impresora");
    Route::put("editar-impresora","$controlador@editar_impresora");
    Route::get("listar-impresoras","$controlador@listar_impresoras");
    Route::delete("eliminar-impresora","$controlador@eliminar_impresora");
  });
});
