import page from '../page'
export default [
    {
        path: '/proveedores',
        name: 'proveedores.listar',
        component: page('proveedores/proveedores'),
        // children: [
        //     {
        //         path: 'ver/:id_evento',
        //         name: 'eventos.ver',
        //         component: page('eventos/verDetalle')
        //     },
        // ]
    }
]
