<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('eventos')->group( function(){
        $controlador = "EventosController";
        Route::post("registrar-evento","$controlador@registrar_evento");
        Route::get("listar-eventos","$controlador@listar_eventos");
        Route::put("editar-evento","$controlador@editar_evento");
        // Route::delete("{id_invitado}/eliminar-invitado","$controlador@eliminar_invitado");
    });
});
