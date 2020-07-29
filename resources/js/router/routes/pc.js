import page from '../page'
export default [
  {
    path: '/pc',
    name: 'administrarpc.listar',
    component: page('pc/encabezadoPc'),
    children: [
      {
        path: 'listar',
        name: 'chasis.listar',
        component: page('pc/listarChasis'),
      },
      {
        path: 'equipos',
        name: 'equipos.listar',
        component: page('pc/listarEquipos')
      },
      {
        path: 'nuevo-equipo',
        name: 'equipo.registrar',
        component: page('pc/registrarEquipo')
      },
      {
        path: 'eventos',
        name: 'eventospc.listar',
        component: page('pc/listarEventos')
      },
    ]
  },
]
