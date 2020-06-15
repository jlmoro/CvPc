<?php
Route::group(['middleware' =>'auth:api'], function (){
  Route::prefix('pc')->group( function(){
    $controlador = "PcController";
    Route::post("registrar-pc","$controlador@registrar_pc");
    Route::put("editar-pc","$controlador@editar_pc");
    Route::put("{id_pc}/cambiar-estado","$controlador@cambiar_estado");
    Route::get("listar-pc","$controlador@listar_pc");
    Route::delete("{id_pc}/eliminar-pc","$controlador@eliminar_pc");

    
  });
});
