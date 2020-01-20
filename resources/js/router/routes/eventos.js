import page from '../page'
export default [
    {
        path: '/eventos',
        name: 'eventos.listar',
        component: page('eventos/eventos'),
        children: [
            {
                path: 'ver/:id_evento',
                name: 'eventos.ver',
                component: page('eventos/verDetalle')
            },
        ]
    }
]
