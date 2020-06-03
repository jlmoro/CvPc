import page from '../page'
export default [
  {
    path: '/impresoras',
    name: 'impresoras.listar',
    component: page('impresoras/impresoras'),
  },
  {
    path: '/impresoras/eventos',
    name: 'eventos.impresoras',
    component: page('impresoras/listarEventos')
  },
]
