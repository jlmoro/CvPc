<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('eventos')->group( function(){
        $controlador = "EventosController";
        Route::post("registrar-evento","$controlador@registrar_evento");
        Route::get("listar-eventos","$controlador@listar_eventos");
        Route::put("editar-evento","$controlador@editar_evento");

        Route::get("{id_evento}/datos-solucion-evento","$controlador@datos_solucion_evento");
        Route::post("{id_evento}/fecha-solucion-evento","$controlador@fecha_solucion_evento");
    });
});
