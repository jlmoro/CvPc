import page from '../page'
export default [
  {
    path: '/printer',
    name: 'listado.printer',
    component: page('impresoras/encabezadoImpresoras'),
    children: [
      {
        path: 'impresoras',
        name: 'impresoras.listar',
        component: page('impresoras/impresoras'),
      },
      {
        path: 'impresoras/eventos',
        name: 'eventos.impresoras',
        component: page('impresoras/listarEventos')
      },
    ]
  }
]
