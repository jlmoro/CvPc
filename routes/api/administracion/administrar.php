<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('administrar')->group( function(){
        $controlador = "AdministrarController";
        Route::get("listar-administrar","$controlador@listar_administrar");

        Route::prefix('menu')->group( function(){
            $controlador = "MenuController";
            Route::get("listar-menu","$controlador@listar_menu");
            Route::post("crear-item-menu","$controlador@crear_evento");
            Route::post("crear-subitem-menu","$controlador@crear_evento");
            // Route::put("editar-invitado","$controlador@editar_invitado");
            // Route::delete("{id_invitado}/eliminar-invitado","$controlador@eliminar_invitado");
        });
        Route::prefix('usuarios')->group( function(){
            $controlador = "UsuariosController";
            Route::post("crear-evento","$controlador@crear_evento");
            Route::get("listar-eventos","$controlador@listar_eventos");
            // Route::put("editar-invitado","$controlador@editar_invitado");
            // Route::delete("{id_invitado}/eliminar-invitado","$controlador@eliminar_invitado");
        });
        Route::prefix('areas')->group( function(){
            $controlador = "AreasController";
            Route::get("listar-areas","$controlador@listar_areas");
            Route::post("crear-area","$controlador@crear_area");
            Route::put("editar-area","$controlador@editar_area");
            Route::delete("{id_area}/eliminar-area","$controlador@eliminar_area");

            $controlador2 = "RolesController";
            Route::post("{id_area}/crear-rol","$controlador2@crear_rol");
            Route::put("editar-rol","$controlador2@editar_rol");
            Route::delete("{id_rol}/eliminar-rol","$controlador2@eliminar_rol");
        });
        Route::prefix('perifericos-tipos')->group( function(){
            $controlador = "PerifericosTiposController";
            Route::post("crear-evento","$controlador@crear_evento");
            Route::get("listar-eventos","$controlador@listar_eventos");
            // Route::put("editar-invitado","$controlador@editar_invitado");
            // Route::delete("{id_invitado}/eliminar-invitado","$controlador@eliminar_invitado");
        });
        Route::prefix('eventos-tipos')->group( function(){
            $controlador = "EventosTiposController";
            Route::post("crear-evento-tipo","$controlador@crear_evento_tipo");
            Route::get("listar-eventos","$controlador@listar_eventos");
            Route::put("editar-evento-tipo","$controlador@editar_evento_tipo");
            Route::delete("{id_tipo_evento}/eliminar-evento-tipo","$controlador@eliminar_evento_tipo");

            $controlador2 = "EventosTiposDescripcionController";
            Route::post("{id_evento_tipo}/crear-evento-descripcion","$controlador2@crear_evento_descripcion");

        });
        Route::prefix('encargados')->group( function(){
            $controlador = "EncargadosController";
            Route::post("crear-encargado","$controlador@crear_encargado");
            Route::get("listar-encargados","$controlador@listar_encargados");
            Route::delete("{id_encargado}/eliminar-encargado","$controlador@eliminar_encargado");
            // Route::put("editar-invitado","$controlador@editar_invitado");
        });
        Route::prefix('solucion-posible')->group( function(){
            $controlador = "SolucionesPosiblesController";
            Route::post("registrar-solucion-posible","$controlador@registrar_solucion_posible");
            Route::get("listar-soluciones-posibles","$controlador@listar_soluciones_posibles");
            Route::put("actualizar-solucion-posible","$controlador@actualizar_solucion_posible");
            Route::delete("{id_solucion}/eliminar-solucion-posible","$controlador@eliminar_solucion_posible");
        });
        Route::prefix('perifericos')->group( function(){
            $controlador = "PerifericosTiposController";
            Route::post("registrar-periferico","$controlador@registrar_periferico");
            Route::get("listar-perifericos","$controlador@listar_perifericos");
            Route::put("editar-periferico","$controlador@editar_periferico");
            Route::delete("{id_periferico}/eliminar-periferico","$controlador@eliminar_periferico");
        });
    });
});
