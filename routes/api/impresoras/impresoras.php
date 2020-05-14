<?php
Route::group(['middleware' =>'auth:api'], function (){
  Route::prefix('impresora')->group( function(){
    $controlador = "ImpresoraController";
    Route::post("crear-impresora","$controlador@crear_impresora");
    Route::get("listar-impresoras","$controlador@listar_impresoras");
  });
});
