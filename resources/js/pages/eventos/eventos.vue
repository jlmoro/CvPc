<template>
  <section class="lista-eventos">
    <encabezado-datos tituloEncabezado="Listado de Eventos" tituloBoton="Registrar Evento" @accionBonton="modalCrarEventos"/>

    <div class="row mb-3">
      <div class="col-md-4">
        <el-input v-model="search" placeholder="Buscar..." clearable></el-input>
      </div>
    </div>

    <table class="table">
      <thead>
        <th>#</th>
        <th>Tipo Dispositivo</th>
        <th>Tipo Evento</th>
        <th>Placa Dispositivo</th>
        <th>Actualizado por</th>
        <th>Fecha</th>
        <th colspan="2">Acciones</th>
      </thead>
      <tbody>
        <tr v-for="(data,e) in lista_eventos" :key="e">
          <td>{{ e + 1}}</td>
          <td>
            <span v-show="data.tipo_dispositivo === 1">PC</span>
            <span v-show="data.tipo_dispositivo === 2">Pantalla</span>
            <span v-show="data.tipo_dispositivo === 3">Impresora</span>
          </td>
          <td><span class="letra-capital">{{data.nombre_evento}}</span></td>
          <td>
            <span v-show="data.id_impresora !== null" class="letra-capital">{{data.marca_impresora}} - {{data.placa_impresora}}</span>
            <span v-show="data.id_pantalla !== null" class="letra-capital">{{data.marca_pantalla}} - {{data.placa_pantalla}}</span>
            <span v-show="data.id_pc !== null" class="letra-capital">{{data.marca_pc}} - {{data.placa_pc}}</span>
          </td>
          <td><span class="letra-capital">{{data.usuario_actualiza}}</span></td>
          <td><span>{{data.created_at | formato_fecha('DD-MMM-Y')}}</span></td>
          <td>
            <el-popover
              placement="bottom"
              title="Descripción"
              width="200"
              trigger="hover"
              :content="data.descripcion">
              <span slot="reference" class="mdi mdi-information f-18 icon-descripcion"></span>
            </el-popover>
          </td>
          <td class="text-center">
            <i class="mdi mdi-pencil accion-editar" @click="modalEditarEvento(data)"></i>
          </td>
          <td>
            <el-tooltip content="Detalles estado evento" placement="bottom">
              <i class="mdi mdi-magnify" @click="abrirModalVerDetalle(data)"></i>
            </el-tooltip>
          </td>
        </tr>
      </tbody>
    </table>

    <modal-crear ref="modalCrearEvento" :ruta="ruta" @evento:registrado="listar_eventos" :tiposEventos="tiposEventos"/>

    <modal-editar ref="modalEditarEvento" :ruta="ruta" @evento:actualizado="listar_eventos" :tiposEventos="tiposEventos"/>

    <modal-asignar-fecha ref="modalAsignarFecha" :ruta="ruta" @evento:asignado="listar_eventos" :usuarios="listaUsuarios"/>

    <modal-estado-evento ref="modalEstadoEventos"
    titulo="Estado Evento"
    cuerpo="No se ha asignado fecha de solución ¿Desea asignar?"
    @confirmarE="modalAsignarFecha"
    />

    <modal-ver-detalle ref="modalVerDetalles"/>
  </section>
</template>

<script>
export default {
  components:{
    modalCrear: () => import('./componentes/modalCrearEvento'),
    modalEditar: () => import('./componentes/modalEditarEvento'),
    modalAsignarFecha: () => import('./componentes/modalAsignarFecha'),
    modalVerDetalle: () => import('./verDetalle')
  },
  data(){
    return{
      ruta:'/api/eventos',
      lista_eventos:[],
      search: '',
      tiposEventos:[],
      listaUsuarios:[],
      pruebaEvent:''
    }
  },
  computed:{
    listadoEventos(){
      return this.lista_eventos.filter(data => !this.search || data.tipo_dispositivo.toLowerCase().includes(this.search.toLowerCase()))
    }
  },
  mounted(){
    this.listar_eventos()
    this.eventosTipos()
    this.listarUsuarios()
  },
  methods:{
    modalAsignarFecha() {
      let dato = this.pruebaEvent
      this.$refs.modalEstadoEventos.toggle()
      this.$refs.modalAsignarFecha.toggle(dato)
      console.log('click');
    },
    async listar_eventos(){
      try {
        const {data} = await axios(`${this.ruta}/listar-eventos`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar eventos',data.error)
          return
        }
        this.lista_eventos = data
      } catch (e){
        console.warn(e);
      }
    },
    async eventosTipos(){
      try {
        const {data} = await axios(`/api/select/listar-tipos-eventos`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar',data.error)
          return
        }
        this.tiposEventos = data
      } catch (e) {
        console.warn(e);
      }
    },
    async listarUsuarios(){
      try {
        const {data} = await axios(`/api/select/listar-usuarios`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al mostrar usuarios',data.error)
          return
        }
        this.listaUsuarios = data
      } catch (e) {
        console.warn(e);
      }
    },
    abrirModalVerDetalle(dato){
      this.pruebaEvent = dato
      if (dato.estado_evento !== null) {
        this.$refs.modalVerDetalles.toggle(dato)
      }else {
        this.$refs.modalEstadoEventos.toggle()
      }
    },
    modalEditarEvento(dato){
      this.$refs.modalEditarEvento.toggle(dato)
    },
    modalCrarEventos(){
      this.$refs.modalCrearEvento.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
.lista-eventos{
  .icon-descripcion{
    &:hover{
      color: #0094fd;
    }
  }
  .accion-editar{
    border: solid 1px midnightblue;
    border-radius: 3px;
    padding: 1px 2px 1px 2px;
    color: midnightblue;
    &:hover{
      background-color: midnightblue;
      color: white;
      cursor: pointer;
    }
  }
}
</style>
