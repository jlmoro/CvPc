<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('select')->group( function(){
        $controlador = "SelectController";
        Route::get("listar-areas","$controlador@listar_areas");
        Route::get("{id_area}/listar-roles","$controlador@listar_roles");
        Route::get("listar-encargados","$controlador@listar_encargados");
        Route::get("listar-proveedores","$controlador@listar_proveedores");
    });
});
