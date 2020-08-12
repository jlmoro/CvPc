import page from '../page'
export default [
  {
    path: '/screen',
    name: 'listado.printer',
    component: page('pantallas/encabezadoPantallas'),
    children: [
      {
        path: 'pantallas',
        name: 'pantallas.listar',
        component: page('pantallas/pantallas'),
      },
      {
        path: 'pantallas/eventos',
        name: 'eventos.pantallas',
        component: page('pantallas/listarEventos')
      },
    ]
  }
]
