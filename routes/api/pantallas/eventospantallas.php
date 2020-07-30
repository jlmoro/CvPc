<?php
Route::group(['middleware' =>'auth:api'], function (){
  Route::prefix('pantalla')->group( function(){
    Route::prefix('eventos')->group( function(){
      $controlador = "EventosController";
      Route::post("{id_pantalla}/registrar-evento-pantalla","$controlador@registrar_evento_pantalla");
      Route::get("listar-eventos-pantallas","$controlador@listar_eventos_pantallas");
      Route::post("{id_evento}/fecha-solucion-evento-pantalla","$controlador@fecha_solucion_evento_pantalla");
      Route::put("{id_evento}/evento-pantalla-resuelto","$controlador@evento_pantalla_resuelto");

      Route::delete("{id_evento}/eliminar-evento-pantalla","$controlador@eliminar_evento_pantalla");
      
    });
  });
});
