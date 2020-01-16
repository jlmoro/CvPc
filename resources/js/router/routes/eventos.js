import page from '../page'
export default [
    {
        path: '/configurar/eventos',
        name: 'configurar.eventos',
        component: page('configurar/eventos/index'),
        children: [
            {
                path: 'tipos',
                name: 'configurar.eventos.tipos',
                component: () => import('~/pages/configurar/eventos/tiposEventos').then(m => m.default || m)
            },
            {
                path: 'campos',
                name: 'configurar.eventos.campos',
                component: () => import('~/pages/configurar/eventos/datos').then(m => m.default || m)
            },
            {
                path: 'clasificacion',
                name: 'configurar.eventos.clasificacion',
                component: page('configurar/eventos/clasificaciones')
            },
            {
                path: 'gastos',
                name: 'configurar.eventos.gastos',
                component: page('configurar/eventos/gastos')
            },
            {
                path: 'lecciones',
                name: 'configurar.eventos.lecciones',
                component: page('configurar/eventos/lecciones')
            },
            {
                path: 'correos/aspecto',
                name: 'configurar.eventos.correo',
                component: page('configurar/correos/diseno'),
                props: {
                    modulo:8
                }
            },
        ]
    }
]
