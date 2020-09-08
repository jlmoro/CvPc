<?php
Route::group(['middleware' =>'auth:api'], function (){
  Route::prefix('pantalla')->group( function(){
    $controlador = "PantallaController";
    Route::post("registrar-pantalla","$controlador@registrar_pantalla");
    Route::put("editar-pantalla","$controlador@editar_pantalla");
    Route::put("{id_pantalla}/cambiar-estado","$controlador@cambiar_estado");
    Route::get("listar-pantallas","$controlador@listar_pantallas");
    Route::delete("{id_pantalla}/eliminar-pantalla","$controlador@eliminar_pantalla");

    Route::get("descarga-pdf-pantallas","$controlador@descarga_pdf_pantallas");
  });
});
