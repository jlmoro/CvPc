<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('select')->group( function(){
        $controlador = "SelectController";
        Route::get("listar-areas","$controlador@listar_areas");
        Route::get("{id_area}/listar-roles","$controlador@listar_roles");
    });
});
