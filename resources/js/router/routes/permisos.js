import page from '../page'
export default [
    {
        path: '/permisos',
        name: 'permisos.listar',
        component: page('permisos/permisos'),
        // children: [
        //     {
        //         path: 'ver/:id_evento',
        //         name: 'eventos.ver',
        //         component: page('eventos/verDetalle')
        //     },
        // ]
    }
]
