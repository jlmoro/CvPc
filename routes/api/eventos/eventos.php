<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('eventos')->group( function(){
        $controlador = "EventosController";
        Route::get("listar-eventos","$controlador@listar_eventos");

        Route::get("listar-eventos-pc","$controlador@listar_eventos_pc");
        Route::get("listar-eventos-pantallas","$controlador@listar_eventos_pantallas");
        Route::get("listar-eventos-impresoras","$controlador@listar_eventos_impresoras");

        Route::post("registrar-evento","$controlador@registrar_evento");

        Route::post("registrar-evento-pc","$controlador@registrar_evento_pc");

        Route::post("registrar-evento-pantalla","$controlador@registrar_evento_pantalla");

        Route::put("editar-evento","$controlador@editar_evento");

        Route::put("editar-evento-pc","$controlador@editar_evento_pc");
        Route::put("editar-evento-impresora","$controlador@editar_evento_impresora");
        Route::put("editar-evento-pantalla","$controlador@editar_evento_pantalla");

        Route::get("{id_evento}/datos-solucion-evento","$controlador@datos_solucion_evento");
        Route::post("{id_evento}/fecha-solucion-evento","$controlador@fecha_solucion_evento");
    });
});
