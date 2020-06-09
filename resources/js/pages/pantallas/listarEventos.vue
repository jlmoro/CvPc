<template>
  <section class="lista-eventos">
    <!-- <encabezado-datos tituloEncabezado="Eventos Impresora" tituloBoton="Registrar Evento" @accionBonton="modalCrearEventos"/> -->
    <div class="row">
      <div class="col-md-12 text-center">
        <h5>Eventos Pantallas</h5>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4">
        <el-input v-model="search" placeholder="Buscar..." clearable></el-input>
      </div>
    </div>

    <table class="table">
      <thead>
        <th>#</th>
        <th>Tipo Evento</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Placa</th>
        <th>Creado por</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Descripción</th>
        <th colspan="2">Acciones</th>
      </thead>
      <tbody>
        <tr v-for="(data,e) in lista_eventos" :key="e">
          <td>{{ e + 1}}</td>
          <td><span class="letra-capital">{{data.tipo_evento}}</span></td>
          <td><span class="letra-capital">{{data.pantalla_marca}}</span></td>
          <td><span class="letra-capital">{{data.pantalla_modelo}}</span></td>
          <td><span class="letra-capital">{{data.pantalla_placa}}</span></td>
          <td><span class="letra-capital">{{data.usuario_nombre_actualiza}} {{data.usuario_apellido_actualiza}}</span></td>
          <td><span>{{data.created_at | formato_fecha('DD-MMM-Y')}}</span></td>
          <td>
            <span v-show="data.evento_estado == 1" class="f-14 texto-info estado-1">Esperando</span>
            <span v-show="data.evento_estado == 2" class="f-14 texto-info estado-2" @click="eventoResuelto(data)">Asignado</span>
            <span v-show="data.evento_estado == 3" class="f-14 texto-info estado-3">Resuelto</span>
          </td>
          <td><span>{{data.descripcion}}</span></td>

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

    <modal-crear ref="modalCrearEvento" :ruta="ruta" @evento:registrado="listar_eventos_pantalla" :tiposEventos="tiposEventos"/>

    <modal-editar ref="modalEditarEvento" :ruta="ruta" @evento:actualizado="listar_eventos_pantalla" :tiposEventos="tiposEventos"/>

    <modal-asignar-fecha ref="modalAsignarFecha" :ruta="ruta" @evento:asignado="listar_eventos_pantalla" :usuarios="listaUsuarios"/>

    <modal-estado-evento ref="modalEstadoEventos"
    titulo="Estado Evento"
    cuerpo="No se ha asignado fecha de solución ¿Desea asignar?"
    @confirmarE="modalAsignarFecha"
    />

    <modal-estado-evento ref="modalEventoResuelto"
    titulo="Evento Resuelto"
    cuerpo="¿ Se ha resuelto la eventualidad ?"
    @confirmarE="eventualidadResuelta"
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
      ruta:'/api/pantalla/eventos',
      lista_eventos:[],
      search: '',
      tiposEventos:[],
      listaUsuarios:[],
      pruebaEvent:'',
      idEvento:null,
    }
  },
  computed:{
    listadoEventos(){
      return this.lista_eventos.filter(data => !this.search || data.placa.toLowerCase().includes(this.search.toLowerCase()))
    }
  },
  mounted(){
    this.listar_eventos_pantalla()
    this.eventosTipos()
    this.listarUsuarios()
  },
  methods:{
    async eventualidadResuelta(){
      try {
        const {data} = await axios.put(`${this.ruta}/${this.idEvento}/evento-pantalla-resuelto`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al confirmar',data.error)
          return
        }
        this.$refs.modalEventoResuelto.toggle()
        this.listar_eventos_pantalla()

      } catch (e) {
        console.warn(e);
      }
    },
    eventoResuelto(dato){
      this.idEvento = dato.id
      this.$refs.modalEventoResuelto.toggle()
    },
    modalAsignarFecha() {
      let dato = this.pruebaEvent
      this.$refs.modalEstadoEventos.toggle()
      this.$refs.modalAsignarFecha.toggle(dato)
    },
    async listar_eventos_pantalla(){
      try {
        const {data} = await axios(`${this.ruta}/listar-eventos-pantallas`)
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
      // console.log(dato,"datoooooooo");
      this.pruebaEvent = dato
      if (dato.evento_fecha_resolver !== null) {
        this.$refs.modalVerDetalles.toggle(dato)
      }else {
        this.$refs.modalEstadoEventos.toggle()
      }
    },
    modalEditarEvento(dato){
      this.$refs.modalEditarEvento.toggle(dato)
    },
    modalCrearEventos(){
      this.$refs.modalCrearEvento.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
.lista-eventos{
  .estado-1{
    background-color: gray;
    padding: 4px;
    border-radius: 4px;
    color: whitesmoke;
  }
  .estado-2{
    background-color: #1c54a9;
    padding: 4px;
    border-radius: 4px;
    color: whitesmoke;
    &:hover{
      cursor: pointer;
    }
  }
  .estado-3{
    background-color: #0c710f;
    padding: 4px;
    border-radius: 4px;
    color: whitesmoke;
  }
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
