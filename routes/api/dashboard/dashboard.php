<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('dashboard')->group( function(){
        Route::prefix('principal')->group( function(){
            $controlador = "DashboardController";
            Route::get("listar-eventos","$controlador@listar_eventos"); //listado de eventos por tipo de evento y cantidad
            Route::get("eventos-calendario","$controlador@eventos_calendario"); //listado de eventos del calendario
        });
    });
});
