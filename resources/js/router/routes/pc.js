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
        path: 'fuentes',
        name: 'fuentes.listar',
        component: page('pc/listarFuentes')
      },
      {
        path: 'procesador',
        name: 'procesador.listar',
        component: page('pc/listarProcesadores')
      },
      {
        path: 'eventos',
        name: 'eventos.pc',
        component: page('pc/listarEventos')
      },
    ]
  },
]
