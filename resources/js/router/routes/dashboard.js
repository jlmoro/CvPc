import page from '../page'
export default [
    {
        path: '/dashboard',
        name: 'dashboard.principal',
        component: page('dashboard/principal'),
        // children: [
        //     {
        //         path: 'ver/:id_evento',
        //         name: 'eventos.ver',
        //         component: page('eventos/verDetalle')
        //     },
        // ]
    }
]
