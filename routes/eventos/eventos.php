<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('eventos')->group( function(){
        $controlador = "EventosController";
        Route::post("crear-evento","$controlador@crear_evento");
        Route::get("listar-eventos","$controlador@listar_eventos");
        // Route::put("editar-invitado","$controlador@editar_invitado");
        // Route::delete("{id_invitado}/eliminar-invitado","$controlador@eliminar_invitado");
    });
});
