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
        path: 'memoriaram',
        name: 'ram.listar',
        component: page('pc/listarMemoriaRam')
      },
      {
        path: 'board',
        name: 'board.listar',
        component: page('pc/listarPlacasBase')
      },
      {
        path: 'discos',
        name: 'disco.listar',
        component: page('pc/listarDisco')
      },
      {
        path: 'perifericos',
        name: 'perife.listar',
        component: page('pc/listarPerifericos')
      },
      {
        path: 'organizarPc',
        name: 'organizar.listar',
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
