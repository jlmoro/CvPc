import page from '../page'
export default [
  {
    path: '/pantallas',
    name: 'pantallas.listar',
    component: page('pantallas/pantallas'),
  },
  {
    path: '/pantallas/eventos',
    name: 'eventos.pantallas',
    component: page('pantallas/listarEventos')
  },
]
