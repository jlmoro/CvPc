import page from '../page'
export default [
  {
    path: '/pantallas',
    name: 'pantallas.listar',
    component: page('pantallas/pantallas'),
    // children: [
    //     {
    //         path: 'ver/:id_evento',
    //         name: 'eventos.ver',
    //         component: page('eventos/verDetalle')
    //     },
    // ]
  }
]
