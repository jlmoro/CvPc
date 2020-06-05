<?php
Route::group(['middleware' =>'auth:api'], function (){
  Route::prefix('impresora')->group( function(){
    Route::prefix('eventos')->group( function(){
      $controlador = "EventosController";
      Route::post("{id_impresora}/registrar-evento-impresora","$controlador@registrar_evento_impresora");
      Route::get("listar-eventos-impresoras","$controlador@listar_eventos_impresoras");
    });
  });
});