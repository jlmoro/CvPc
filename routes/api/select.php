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
        Route::get("listar-usuarios","$controlador@listar_usuarios");

        Route::get("listar-chasis","$controlador@listar_chasis");
        Route::get("listar-fuentes","$controlador@listar_fuentes");
        Route::get("listar-procesador","$controlador@listar_procesador");
        Route::get("listar-ram","$controlador@listar_ram");
        Route::get("listar-board","$controlador@listar_board");
        Route::get("listar-disco","$controlador@listar_disco");
        Route::get("listar-perifericos","$controlador@listar_perifericos");

    });
});
