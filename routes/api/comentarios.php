<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('comentarios')->group( function(){

        Route::prefix('equipo')->group( function(){
          $controlador = "ComentariosController";
          //comentarios equipo
          Route::post("registrar-comentario-equipo","$controlador@registrar_comentario_equipo");
          Route::get("{id_equipo}/listar-comentarios-equipo","$controlador@listar_comentarios_equipo");
        });

    });
});
