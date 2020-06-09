import page from '../page'
export default [
  {
    path: '/pc',
    name: 'administrarpc.listar',
    component: page('pc/encabezadoPc'),
    children: [
      {
        path: 'listar',
        name: 'pc.listar',
        component: page('pc/listarPcs'),
      },
      {
        path: 'organizar',
        name: 'pc.organizar',
        component: page('pc/organizarPc')
      },
      {
        path: 'eventos',
        name: 'eventos.pc',
        component: page('pc/listarEventos')
      },
    ]
  },
]
