<?php
Route::group(['middleware' =>'auth:api'], function (){
  Route::prefix('pc')->group( function(){
    $controlador = "PcController";
    Route::post("registrar-pc","$controlador@registrar_pc"); //ruta para registro de chasís
    Route::put("editar-pc","$controlador@editar_pc");
    Route::put("{id_chasis}/cambiar-estado-chasis","$controlador@cambiar_estado_chasis");
    Route::get("listar-pc","$controlador@listar_pc"); //listado de chasis con paginar
    Route::delete("{id_pc}/eliminar-pc","$controlador@eliminar_pc");

    Route::prefix('disco')->group( function(){
      $controlador = "PcController";
      Route::post("registrar-board","$controlador@registrar_board");
      Route::get("listar-discos","$controlador@listar_disco");
      Route::put("editar-fuente","$controlador@editar_fuente");
      Route::delete("{id_fuente}/eliminar-fuente","$controlador@eliminar_fuente");
    });

    Route::prefix('equipo')->group( function(){
      $controlador = "PcController";
      Route::post("registrar-equipo","$controlador@registrar_equipo");
      Route::get("listar-equipo","$controlador@listar_equipo");
      Route::put("editar-fuente","$controlador@editar_fuente");
      Route::delete("{id_equipo}/eliminando-equipo","$controlador@eliminando_equipo");
    });

  });
});
