import page from '../page'
export default [
  {
    path: '/impresoras',
    name: 'impresoras.listar',
    component: page('impresoras/impresoras'),
    // children: [
    //     {
    //         path: 'ver/:id_evento',
    //         name: 'eventos.ver',
    //         component: page('eventos/verDetalle')
    //     },
    // ]
  }
]
