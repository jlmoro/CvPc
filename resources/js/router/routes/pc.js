import page from '../page'
export default [
  {
    path: '/pc',
    name: 'pc.listar',
    component: page('pc/pc'),
    // children: [
    //     {
    //         path: 'ver/:id_evento',
    //         name: 'eventos.ver',
    //         component: page('eventos/verDetalle')
    //     },
    // ]
  }
]
