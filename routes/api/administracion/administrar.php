<?php
Route::group(['middleware' =>'auth:api'], function (){
    Route::prefix('administrar')->group( function(){
        $controlador = "AdministrarController";
        Route::get("listar-administrar","$controlador@listar_administrar");

        Route::prefix('menu')->group( function(){
            $controlador = "MenuController";
            Route::post("crear-item-menu","$controlador@crear_evento");
            Route::post("crear-subitem-menu","$controlador@crear_evento");
            Route::get("listar-eventos","$controlador@listar_eventos");
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
            Route::post("crear-area","$controlador@crear_area");
            Route::get("listar-areas","$controlador@listar_areas");
            // Route::put("editar-invitado","$controlador@editar_invitado");
            // Route::delete("{id_invitado}/eliminar-invitado","$controlador@eliminar_invitado");
        });
        Route::prefix('roles')->group( function(){
            $controlador = "RolesController";
            Route::post("crear-rol","$controlador@crear_rol");
            Route::get("editar-rol","$controlador@editar_rol");
            // Route::put("editar-invitado","$controlador@editar_invitado");
            // Route::delete("{id_invitado}/eliminar-invitado","$controlador@eliminar_invitado");
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
            Route::post("crear-evento","$controlador@crear_evento");
            Route::get("listar-eventos","$controlador@listar_eventos");
            // Route::put("editar-invitado","$controlador@editar_invitado");
            // Route::delete("{id_invitado}/eliminar-invitado","$controlador@eliminar_invitado");
        });
        Route::prefix('encargados')->group( function(){
            $controlador = "EncargadosController";
            Route::post("crear-evento","$controlador@crear_evento");
            Route::get("listar-eventos","$controlador@listar_eventos");
            // Route::put("editar-invitado","$controlador@editar_invitado");
            // Route::delete("{id_invitado}/eliminar-invitado","$controlador@eliminar_invitado");
        });
    });
});
