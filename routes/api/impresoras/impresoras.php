<?php
Route::group(['middleware' =>'auth:api'], function (){
  Route::prefix('impresora')->group( function(){
    $controlador = "ImpresoraController";
    Route::post("crear-impresora","$controlador@crear_impresora");
    Route::put("editar-impresora","$controlador@editar_impresora");
    Route::put("{id_impresora}/cambiar-estado","$controlador@cambiar_estado");
    Route::get("listar-impresoras","$controlador@listar_impresoras");
    Route::delete("{id_impresora}/eliminar-impresora","$controlador@eliminar_impresora");
  });
});
