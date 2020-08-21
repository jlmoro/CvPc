<template>
  <section class="listar-eventos-pc" v-loading="isLoading">
    <div class="mb-4 text-center">
      <h5 class="mt-4">Lisado de Eventos PC</h5>
    </div>

    <div class="row w-100 mt-4">
      <div class="col-md-12">
        <div class="row mb-3">
          <div class="col-md-6">
            <el-input v-model="search" placeholder="Buscar..." clearable></el-input>
          </div>
          <!-- <div class="col-md-2">
            <i v-if="dataChasis.length > 0" class="mdi mdi-adobe-acrobat icono-pdf" @click="descargaPdf"></i>
          </div> -->
          <div class="col-md-6 text-right">
            <span>Filas: </span>
            <el-select v-model="perPage" @change="cantidadFilas($event)">
              <el-option
                v-for="item in options"
                :key="item.value"
                :label="item.label"
                :value="item.value">
              </el-option>
            </el-select>
          </div>
        </div>
      </div>
    </div>

    <div class="row w-100 justify-content-center m-0">
      <div class="col-md-12 p-0">
        <table class="table" id="my-table" width="100">
          <thead class="thead-light text-center f-13">
            <th>#</th>
            <th>Tipo Evento</th>
            <th>Marca Chasis</th>
            <th>Placa Chasis</th>
            <th>Encargado</th>
            <th>Creado por</th>
            <th>Fecha Registro</th>
            <th>Estado</th>
            <th class="text-center">Descripción</th>
            <th colspan="3" class="text-center">Acciones</th>
          </thead>
          <tbody class="text-center f-12">
            <tr v-for="(data,t) in dataEventosPc" :key="t">
              <td>{{ t + 1}}</td>
              <td><span class="letra-capital">{{data.evento_descripcion}}</span></td>
              <td><span class="letra-capital">{{data.chasis_marca}}</span></td>
              <td>{{data.chasis_placa}}</td>
              <td><span class="letra-capital">{{data.encargado_nombre}}</span></td>
              <td><span class="letra-capital">{{data.usuario_nombre_actualiza}} {{data.usuario_apellido_actualiza}}</span> </td>
              <td>{{data.created_at | formato_fecha('D-MM-YYYY')}}</td>
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
                  <i class="mdi mdi-magnify f-16 detalle-estado" @click="abrirModalVerDetalle(data)"></i>
                </el-tooltip>
              </td>
              <td>
                <el-tooltip content="Ayuda" placement="bottom">
                  <i class="mdi mdi-help-circle-outline f-16 ayuda" @click="modalVerAyuda(data)"></i>
                </el-tooltip>
              </td>
              <td class="text-center">
                <i class="mdi mdi-delete accion-eliminar" @click="modalEliminarEvento(data)"></i>
                <!-- <i class="mdi mdi-delete accion-editar" @click="modalEditarEvento(data)"></i> -->
              </td>
            </tr>
          </tbody>
        </table>

        <div class="overflow-auto">
          <b-pagination pills align="center"
          v-model="currentPage"
          :total-rows="total"
          :per-page="perPage"
          aria-controls="my-table"
          @change="cambioPagina($event)"
          ></b-pagination>
        </div>

      </div>
    </div>

    <modal-asignar-fecha ref="modalAsignarFecha"
    :ruta="ruta" @evento:asignado="dataEventosPc"
    :usuarios="listaUsuarios"
    />

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

    <modal-eliminar ref="eliminarEventoTorre"
    titulo="Eliminar Evento Torre"
    :cuerpo="`¿Desea eliminar evento de la torre ${eliminarEvento.chasis_placa}?`"
    @eliminar="eliminandoEvento"
    />

    <modal-ver-detalle ref="modalVerDetalles"/>

    <modal-ver-ayuda ref="modalVerAyuda"/>

  </section>
</template>
<script>
export default {
  components: {
    modalAsignarFecha: () => import('./componentes/modalAsignarFecha'),
    modalVerDetalle: () => import('./verDetalle'),
    modalVerAyuda: () => import('./verAyuda')
  },
  name: "",
  data(){
    return{
      ruta:'/api/pc/equipo/eventos',
      isLoading:false,
      dataEventosPc:[],
      perPage: 5,
      total:null,
      currentPage: 1,
      pruebaEvent:'',
      listaUsuarios:[],
      search:'',
      eliminarEvento:'',
      options: [{
        value: 5,
        label: '5'
      }, {
        value: 10,
        label: '10'
      }, {
        value: 15,
        label: '15'
      }
    ],
  }
},
mounted() {
  this.isLoading = true;
  Promise.all([
    this.listar_eventos_torre(),
    // this.eventosTipos(),
    this.listarUsuarios(),
  ]).then(res=>{
    this.isLoading = false
  })
},
methods: {
  async eliminandoEvento(){
    try {
      const {data} = await axios.delete(`${this.ruta}/${this.eliminarEvento.id}/eliminar-evento-torre`)
      if (data.error) {
        this.$Helper.notificacion('warning','No es posible eliminar evento',data.error)
        return
      }
      this.$Helper.notificacion('success','Evento Eliminado',data.mensaje)
      this.$refs.eliminarEventoTorre.toggle()
      this.listar_eventos_torre()
    } catch (e) {
      console.warn(e);
    }
  },
  modalEliminarEvento(dato){
    this.eliminarEvento = dato
    this.$refs.eliminarEventoTorre.toggle()
  },
  cantidadFilas(filas){
    this.perPage = filas
    this.currentPage = 1
    this.listar_eventos_torre()
  },
  cambioPagina(page){
    this.currentPage = page
    this.listar_eventos_torre()
  },
  async listar_eventos_torre(){
    try {
      let params = {
        page: this.currentPage,
        perPage: this.perPage
      }

      const {data} = await axios(`${this.ruta}/listar-eventos-torres`,{params})
      if (data.error) {
        this.$Helper.notificacion('warning','No es posible listar eventos',data.error)
        return
      }
      this.dataEventosPc = data.equipo.data

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
  async eventualidadResuelta(){
    try {
      const {data} = await axios.put(`${this.ruta}/${this.idEvento}/evento-torre-resuelto`)
      if (data.error) {
        this.$Helper.notificacion('warning','Error al confirmar',data.error)
        return
      }
      this.$Helper.notificacion('success','Evento Actualizado',data.mensaje)
      this.$refs.modalEventoResuelto.toggle()
      this.listar_eventos_torre()
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
}
}
</script>
<style lang="scss" scoped>
.listar-eventos-pc{
  .detalle-estado{
    &:hover{
      cursor: pointer;
    }
  }
  .ayuda{
    &:hover{
      cursor: pointer;
    }
  }
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
  .el-input{
    width: 315px !important;
  }
  .el-select{
    width: 68px !important;
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
}
</style>
