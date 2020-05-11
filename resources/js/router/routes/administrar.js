import page from '../page'
export default [
    {
        path: '/administrar',
        name: 'administrar.listar',
        component: page('administrar/encabezadoAdministrar'),
        children: [
            {
                path: '/areas/listar',
                name: 'areas.listar',
                component: page('administrar/areas/listar')
            },
            {
                path: '/encargados/listar',
                name: 'encargados.listar',
                component: page('administrar/encargados/listar')
            },
            {
                path: '/soluciones/listar',
                name: 'soluciones.listar',
                component: page('administrar/solucionesPosibles/listar')
            },
            {
                path: '/eventosTipos/listar',
                name: 'eventosTipos.listar',
                component: page('administrar/eventosTipos/listar')
            },
            {
                path: '/menu/listar',
                name: 'menu.listar',
                component: page('administrar/menu/listar')
            },
        ]
    },
    // {
    //     path: '/areas/listar',
    //     name: 'areas.listar',
    //     component: page('administrar/areas/listar')
    // },
    // {
    //     path: '/encargados/listar',
    //     name: 'encargados.listar',
    //     component: page('administrar/encargados/listar')
    // }
]
