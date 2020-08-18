<?php
Route::group(['middleware' =>'auth:api'], function (){
  Route::prefix('pc')->group( function(){
    $controlador = "PcController";
    Route::post("registrar-pc","$controlador@registrar_pc"); //ruta para registro de chasís
    Route::put("editar-pc","$controlador@editar_pc");
    Route::put("{id_chasis}/cambiar-estado-chasis","$controlador@cambiar_estado_chasis");
    Route::get("listar-pc","$controlador@listar_pc"); //listado de chasis con paginar
    Route::delete("{id_pc}/eliminar-pc","$controlador@eliminar_pc");

    Route::get("descarga-pdf","$controlador@descarga_pdf"); //ruta para registro de chasís

    Route::prefix('equipo')->group( function(){
      $controlador = "PcController";
      Route::post("registrar-equipo","$controlador@registrar_equipo");
      Route::get("listar-equipo","$controlador@listar_equipo");
      Route::put("editar-fuente","$controlador@editar_fuente");
      Route::delete("{id_equipo}/eliminando-equipo","$controlador@eliminando_equipo");
      Route::put("{id_equipo}/cambiar-estado-equipo","$controlador@cambiar_estado_equipo");

      Route::get("{id_equipo}/descarga-pdf-detalles-equipo","$controlador@descarga_pdf_detalles_equipo");

      Route::prefix('eventos')->group( function(){
        $controlador="EventosController";
        Route::post("{id_torre}/registrar-evento-torre","$controlador@registrar_evento_torre");
        Route::get("listar-eventos-torres","$controlador@listar_eventos_torres");
        Route::post("{id_evento}/fecha-solucion-evento-pantalla","$controlador@fecha_solucion_evento_pantalla");
        Route::put("{id_evento}/evento-pantalla-resuelto","$controlador@evento_pantalla_resuelto");

        Route::delete("{id_evento}/eliminar-evento-pantalla","$controlador@eliminar_evento_pantalla");
      });

    });
  });
});
