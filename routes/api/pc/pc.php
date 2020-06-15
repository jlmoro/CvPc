<?php
Route::group(['middleware' =>'auth:api'], function (){
  Route::prefix('pc')->group( function(){
    $controlador = "PcController";
    Route::post("registrar-pc","$controlador@registrar_pc");
    Route::put("editar-pc","$controlador@editar_pc");
    Route::put("{id_pc}/cambiar-estado","$controlador@cambiar_estado");
    Route::get("listar-pc","$controlador@listar_pc");
    Route::delete("{id_pc}/eliminar-pc","$controlador@eliminar_pc");

    Route::prefix('fuente')->group( function(){
      $controlador = "PcController";
      Route::post("registrar-fuente","$controlador@registrar_fuente");
      Route::get("listar-fuentes","$controlador@listar_fuentes");
      Route::put("editar-fuente","$controlador@editar_fuente");
      Route::delete("{id_fuente}/eliminar-fuente","$controlador@eliminar_fuente");
    });

    Route::prefix('procesador')->group( function(){
      $controlador = "PcController";
      Route::post("registrar-procesador","$controlador@registrar_procesador");
      Route::get("listar-procesadores","$controlador@listar_procesadores");
      Route::put("editar-fuente","$controlador@editar_fuente");
      Route::delete("{id_fuente}/eliminar-fuente","$controlador@eliminar_fuente");
    });

    Route::prefix('memoria')->group( function(){
      $controlador = "PcController";
      Route::post("registrar-memoria","$controlador@registrar_memoria");
      Route::get("listar-memorias","$controlador@listar_memorias");
      Route::put("editar-fuente","$controlador@editar_fuente");
      Route::delete("{id_fuente}/eliminar-fuente","$controlador@eliminar_fuente");
    });

    Route::prefix('board')->group( function(){
      $controlador = "PcController";
      Route::post("registrar-board","$controlador@registrar_board");
      Route::get("listar-board","$controlador@listar_board");
      Route::put("editar-fuente","$controlador@editar_fuente");
      Route::delete("{id_fuente}/eliminar-fuente","$controlador@eliminar_fuente");
    });

    Route::prefix('disco')->group( function(){
      $controlador = "PcController";
      Route::post("registrar-board","$controlador@registrar_board");
      Route::get("listar-discos","$controlador@listar_disco");
      Route::put("editar-fuente","$controlador@editar_fuente");
      Route::delete("{id_fuente}/eliminar-fuente","$controlador@eliminar_fuente");
    });

    // Route::prefix('perifericos')->group( function(){
    //     $controlador = "PerifericosTiposController";
    //     Route::post("registrar-periferico","$controlador@registrar_periferico");
    //     Route::get("listar-perifericos","$controlador@listar_perifericos");
    //     Route::put("editar-periferico","$controlador@editar_periferico");
    //     Route::delete("{id_periferico}/eliminar-periferico","$controlador@eliminar_periferico");
    // });

  });
});
