import page from '../page'
export default [
  {
    path: '/pc-principal',
    name: 'principal.listar',
    component: page('pc/principal'),
    // children: [
    //     {
    //         path: 'ver/:id_evento',
    //         name: 'eventos.ver',
    //         component: page('eventos/verDetalle')
    //     },
    // ]
  }
]
