<template>
  <section class="lista-eventos">
    <!-- <encabezado-datos tituloEncabezado="Eventos Impresora" tituloBoton="Registrar Evento" @accionBonton="modalCrearEventos"/> -->
    <div class="row">
      <div class="col-md-12 text-center">
        <h5>Eventos Pantallas</h5>
      </div>
    </div>
    <div class="" v-loading="isLoading">

      <div class="row mb-3">
        <div class="col-md-4">
          <el-input v-model="search" placeholder="Buscar..." clearable></el-input>
        </div>
      </div>

      <table class="table f-12">
        <thead>
          <th>#</th>
          <th>Tipo Evento</th>
          <th>Marca</th>
          <th>Modelo</th>
          <th>Placa</th>
          <th>Creado por</th>
          <th>Fecha</th>
          <th>Estado</th>
          <th class="text-center">Descripción</th>
          <th colspan="3" class="text-center">Acciones</th>
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
              <span v-show="data.evento_estado == 1" class="f-12 texto-info estado-1">Esperando</span>
              <span v-show="data.evento_estado == 2" class="f-12 texto-info estado-2" @click="eventoResuelto(data)">Asignado</span>
              <span v-show="data.evento_estado == 3" class="f-12 texto-info estado-3">Resuelto</span>
            </td>

            <td class="text-center">
              <el-tooltip :content="data.descripcion" placement="bottom">
                <span class="mdi mdi-file-document-outline f-18"></span>
              </el-tooltip>
            </td>

            <td>
              <el-tooltip content="Detalles estado evento" placement="bottom">
                <i class="mdi mdi-magnify f-16" @click="abrirModalVerDetalle(data)"></i>
              </el-tooltip>
            </td>
            <td>
              <el-tooltip content="Ayuda" placement="bottom">
                <i class="mdi mdi-help-circle-outline f-16" @click="modalVerAyuda(data)"></i>
              </el-tooltip>
            </td>
            <td class="text-center">
              <i class="mdi mdi-delete accion-eliminar" @click="modalEliminarEvento(data)"></i>
              <!-- <i class="mdi mdi-delete accion-editar" @click="modalEditarEvento(data)"></i> -->
            </td>
          </tr>
        </tbody>
      </table>
    </div>

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

    <modal-eliminar ref="eliminarEventoPantalla"
    titulo="Eliminar Evento Pantalla"
    :cuerpo="`¿Desea eliminar evento de la pantalla ${eliminarEvento.pantalla_placa}?`"
    @eliminar="eliminandoEvento"
    />

    <modal-ver-detalle ref="modalVerDetalles"/>

    <modal-ver-ayuda ref="modalVerAyuda"/>

  </section>
</template>

<script>
export default {
  components:{
    modalCrear: () => import('./componentes/modalCrearEvento'),
    modalEditar: () => import('./componentes/modalEditarEvento'),
    modalAsignarFecha: () => import('./componentes/modalAsignarFecha'),
    modalVerDetalle: () => import('./verDetalle'),
    modalVerAyuda: () => import('./verAyuda')
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
      isLoading:false,
      eliminarEvento:'',
    }
  },
  computed:{
    listadoEventos(){
      return this.lista_eventos.filter(data => !this.search || data.placa.toLowerCase().includes(this.search.toLowerCase()))
    }
  },
  mounted(){
    this.isLoading = true;
    Promise.all([
      this.listar_eventos_pantalla(),
      this.eventosTipos(),
      this.listarUsuarios(),
    ]).then(res=>{
      this.isLoading = false
    })
  },
  methods:{
    async eliminandoEvento(){
      try {
        const {data} = await axios.delete(`${this.ruta}/${this.eliminarEvento.id}/eliminar-evento-pantalla`)
        if (data.error) {
          this.$Helper.notificacion('warning','No es posible eliminar evento',data.error)
          return
        }
        this.$Helper.notificacion('success','Evento Eliminado',data.mensaje)
        this.$refs.eliminarEventoPantalla.toggle()
        this.listar_eventos_pantalla()
      } catch (e) {
        console.warn(e);
      }
    },
    modalEliminarEvento(dato){
      this.eliminarEvento = dato
      this.$refs.eliminarEventoPantalla.toggle()
    },
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
    modalVerAyuda(dato){
      this.$refs.modalVerAyuda.toggle(dato)
    },
    abrirModalVerDetalle(dato){
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
  .table{
    tbody{
      tr{
        border-radius: 5px;
        transition-duration: .85s;
        &:hover{
          .descripcion-evento{
            background-color: #d3d3d35c;
          }
          background-color: #d3d3d35c;
          transform: translateY(-3px);
          box-shadow: 0px 3px 2px 1px #49505f7d;
          transition-duration: .4s;
        }
      }
    }
  }
  .descripcion-evento{
    resize: none;
    height: 115px;
    width: 188px;
    border: none;
  }
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
  .accion-eliminar{
    border: solid 1px #710a0a;
    border-radius: 2px;
    padding: 2px;
    font-size: 14px;
    color: #710a0a;
    transition-duration: .85;
    &:hover{
      background-color: #710a0a;
      color: white;
      cursor: pointer;
      transition-duration: .4;
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
