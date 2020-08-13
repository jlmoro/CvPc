<template>
  <section class="listar-impresoras" v-loading="estaCargando">
    <encabezado-datos tituloEncabezado="Impresoras" tituloBoton="registrar impresora" @accionBonton="crear_impresora"/>

    <div class="row w-100 mt-4">
      <div class="col-md-12">
        <div class="row mb-3">
          <div class="col-md-6">
            <el-input v-model="search" placeholder="Buscar..." clearable></el-input>
          </div>
          <div class="col-md-2">
            <i v-if="impresoras.length > 0" class="mdi mdi-adobe-acrobat icono-pdf" @click="descargaPdf"></i>
          </div>
          <div class="col-md-4 text-right">
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

    <div class="row w-100 mt-4"  >
      <div class="col-md-12">
        <table class="table table-hover f-12">
          <thead class="thead-light text-center">
            <tr>
              <th>#</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Placa</th>
              <th>Serial</th>
              <th>Encargado</th>
              <th>Proveedor</th>
              <th>Fecha Registro</th>
              <th>Estado</th>
              <th colspan="4">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(data,i) in listadoImpresoras" :key="i">
              <td>{{i + 1}}</td>
              <td><span class="letra-capital">{{data.marca}}</span></td>
              <td>{{data.modelo}}</td>
              <td>{{data.placa}}</td>
              <td>{{data.serial }}</td>
              <td><span class="letra-capital">{{data.nombre_encargado}}</span></td>
              <td><span class="letra-capital">{{data.proveedor}}</span></td>
              <td>{{data.created_at | formato_fecha('D-MMM-YYYY')}}</td>
              <td v-if="data.estado === 1"><button type="button" class="estado act" @click="cambiarEstado(data)">Activa</button></td>
              <td v-else><button type="button" class="estado inact" @click="cambiarEstado(data)">Inactiva</button></td>
              <td>
                <el-popover placement="bottom" title="Observaciones" width="250" trigger="hover"
                :content="data.observaciones">
                <span slot="reference" class="mdi mdi-alert-circle-outline f-20 btnDescrip "></span>
              </el-popover>
            </td>
            <td>
              <i class="mdi mdi-pencil f-16 acciones btnEditar" @click="modalEditar(data)"></i>
            </td>
            <td>
              <i class="mdi mdi-delete f-16 acciones btnEliminar" @click="modalEliminar(data)"></i>
            </td>
            <td>
              <i class="mdi mdi-calendar f-16 acciones btnEventos" @click="modalCrearEvento(data)"></i>
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

    <modal-eliminar ref="modalEliminar"
    titulo="eliminar impresora"
    :cuerpo="`¿Seguro desea eliminar impresora con la placa ${eliminarImp.placa}?`"
    @eliminar="eliminandoImpresora"
    />

    <modal-crear ref="modalCrearImpresora" :ruta="ruta"
    @impresora:creada="listar_impresoras"
    :encargados="encargados" :proveedores="proveedores"/>

    <modal-editar ref="modalEditarImpresora" :ruta="ruta"
    @impresora:actualizada="listar_impresoras"
    :encargados="encargados" :proveedores="proveedores"/>

    <modal-crear-evento ref="modalRegistrarEvento" :ruta="ruta" :tiposEventos="tiposEventos"/>

  </section>
</template>

<script>
export default {
  components:{
    ModalCrear:()=> import('./componentes/modalRegistrarImpresora'),
    ModalEditar:()=> import('./componentes/modalEditarImpresora'),
    ModalCrearEvento:()=> import('./componentes/modalCrearEvento'),
  },
  data(){
    return{
      estaCargando: false,
      ruta:'/api/impresora',
      impresoras:[],
      search: '',
      encargados:[],
      proveedores:[],
      eliminarImp:'',
      tiposEventos:[],
      perPage: 5,
      total:null,
      currentPage: 1,
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
  mounted(){
    this.estaCargando = true
    Promise.all([
      this.listar_impresoras(),
      this.listarEncargados(),
      this.listarProveedores(),
      this.eventosTipos(),
    ]).then(res=>{
      this.estaCargando = false
    })
  },
  computed:{
    listadoImpresoras(){
      return this.impresoras.filter(data => !this.search || data.marca.toLowerCase().includes(this.search.toLowerCase()))
    }
  },
  methods:{
    descargaPdf(){
      try {
        window.open(`${this.ruta}/descarga-pdf-impresoras`)

      } catch (e) {
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
    async cambiarEstado(dato){
      try {
        const {data} = await axios.put(`${this.ruta}/${dato.id}/cambiar-estado`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al cambiar estado',data.error)
          return
        }
        this.$Helper.notificacion('success','Estado Actualizado',data.mensaje)
        this.listar_impresoras()
      } catch (e) {
        console.warn(e);
      }
    },
    async eliminandoImpresora(){
      try {
        const {data} = await axios.delete(`${this.ruta}/${this.eliminarImp.id}/eliminar-impresora`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al eliminar impresora',data.error)
          return
        }
        this.$Helper.notificacion('success','Eliminado Correctamente',data.mensaje)
        this.listar_impresoras()
        this.$refs.modalEliminar.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    modalEliminar(dato){
      this.eliminarImp = dato
      this.$refs.modalEliminar.toggle()
    },
    crear_impresora(){
      this.$refs.modalCrearImpresora.toggle()
    },
    async listar_impresoras(){
      try {
        let params = {
          page: this.currentPage,
          perPage: this.perPage
        }
        const {data} = await axios(`${this.ruta}/listar-impresoras`,{params})
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar',data.error)
          return
        }

        this.impresoras = data.impresoras.data
        this.perPage = data.paginate.perPage
        this.currentPage = data.paginate.currentPage
        this.total = data.paginate.total

      } catch (e){
        console.warn(e);
      }
    },
    cantidadFilas(filas){
      this.perPage = filas
      this.currentPage = 1
      this.listar_impresoras()
    },
    cambioPagina(page){
      this.currentPage = page
      this.listar_impresoras()
    },
    async listarEncargados() {
      try {
        const {data} = await axios(`/api/select/listar-encargados`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error listar encargados',data.error)
          return
        }
        this.encargados = data
      } catch (e) {
        console.warn(e);
      }
    },
    async listarProveedores() {
      try {
        const {data} = await axios(`/api/select/listar-proveedores`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error listar proveedores',data.error)
          return
        }
        this.proveedores = data
      } catch (e) {
        console.warn(e);
      }
    },
    modalCrearEvento(dato){
      this.$refs.modalRegistrarEvento.toggle(dato)
    },
    modalEditar(dato){
      this.$refs.modalEditarImpresora.toggle(dato)
    }
  }
}
</script>

<style lang="scss" scoped>
.listar-impresoras{
  .icono-pdf{
    border: 1px solid #710606e6;
    border-radius: 2px;
    padding: 3px;
    font-size: 16px;
    color: white;
    background-color: #710606e6;
    transition-duration: .85s;
    &:hover{
      color: #710606e6;
      background-color: white;
      transition-duration: .4s;
      cursor: pointer;
    }
  }
  .el-input{
    width: 315px !important;
  }
  .el-select{
    width: 68px !important;
  }
  .table{
    tbody{
      tr{
        border-radius: 5px;
        transition-duration: .85s;
        &:hover{
          background-color: #c0c4cc;
          transform: translateY(-3px);
          box-shadow: 0px 3px 2px 1px #49505f7d;
          transition-duration: .4s;
        }
      }
    }
  }

  .btnEventos{
    color: white;
    border: solid 1px midnightblue;
    background-color: midnightblue;
    transition-duration: .4;
    &:hover{
      background-color: white;
      color: midnightblue;
      transition-duration: .85;
      cursor: pointer;
    }
  }
  .estado{
    border-radius: 5px;
    padding: 2px;
    font-size: 13px;
    text-align: center;
    color: white;
    border: none;
  }
  .act{
    background-color: #076107cf;
  }
  .inact{
    background-color: #790707e8;
  }
  .acciones{
    border-radius: 3px;
    padding: 1px 2px 1px 2px;
    color: white;
  }
  .btnEliminar{
    border: solid 1px #750303de;
    background-color: #750303de;
    transition-duration: .4;
    &:hover{
      color: #750303de;
      background-color: white;
      transition-duration: .85;
      cursor: pointer;
    }
  }
  .btnEditar{
    border: solid 1px #d28608cf;
    background-color: #d28608cf;
    transition-duration: .4;
    &:hover{
      color: #d28608cf;
      background-color: white;
      transition-duration: .85;
      cursor: pointer;
    }
  }
}
</style>
