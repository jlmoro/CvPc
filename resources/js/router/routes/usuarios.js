import page from '../page'
export default [
    {
        path: '/usuarios',
        name: 'usuarios.listar',
        component: page('usuarios/usuarios'),
        // children: [
        //     {
        //         path: 'ver/:id_evento',
        //         name: 'eventos.ver',
        //         component: page('eventos/verDetalle')
        //     },
        // ]
    }
]
