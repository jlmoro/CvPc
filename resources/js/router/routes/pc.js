import page from '../page'
export default [
  {
    path: '/pc-principal',
    name: 'pc.listar',
    component: page('pc/principal'),
    children: [
        {
            path: 'eventos',
            name: 'eventos.pc',
            component: page('pc/listarEventos')
        },
    ]
  }
]
