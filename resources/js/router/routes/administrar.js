import page from '../page'
export default [
    {
        path: '/administrar',
        name: 'administrar.listar',
        component: page('administrar/administrar'),
        children: [
            {
                path: 'areas/listar',
                name: 'areas.listar',
                component: page('administrar/areas/listar')
            },
            {
                path: 'encargados/listar',
                name: 'encargados.listar',
                component: page('administrar/encargados/listar')
            },
        ]
    }
]
