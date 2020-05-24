<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('select')->group( function(){
        $controlador = "SelectController";
        Route::get("listar-areas","$controlador@listar_areas");
        Route::get("{id_area}/listar-roles","$controlador@listar_roles");
        Route::get("listar-encargados","$controlador@listar_encargados");
        Route::get("listar-proveedores","$controlador@listar_proveedores");
        Route::get("listar-tipos-eventos","$controlador@listar_tipos_eventos");
        Route::get("listar-pc","$controlador@listar_pc");
        Route::get("listar-pantallas","$controlador@listar_pantallas");
        Route::get("listar-impresoras","$controlador@listar_impresoras");
    });
});
