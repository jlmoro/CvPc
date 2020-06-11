<template>
  <section class="lista-pantallas">
    <encabezado-datos tituloEncabezado="Listado de Pantallas" tituloBoton="registrar pantalla" @accionBonton="modalRegistrarPantalla"/>

    <div class="row w-100 mt-4" v-loading="isLoading">
      <div class="col-md-12">
        <div class="row mb-3">
          <div class="col-md-4">
            <el-input v-model="search" placeholder="Buscar..." clearable></el-input>
          </div>
        </div>
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
          <tr v-if="data" v-for="(data,i) in listadoPantallas" :key="i">
            <td>{{i + 1}}</td>
            <td><span class="letra-capital">{{data.marca}}</span></td>
            <td><span class="letra-capital">{{data.modelo}}</span></td>
            <td>{{data.placa}}</td>
            <td>{{data.serial}}</td>
            <td><span class="letra-capital">{{data.nombre_encargado}}</span></td>
            <td><span class="letra-capital">{{data.proveedor}}</span></td>
            <td>{{data.created_at | formato_fecha('DD-MM-yyyy')}}</td>
            <td class="text-center">
              <button v-if="data.estado === 1" type="button" class="btn-activo f-12" @click="cambiarEstado(data)" >Activo</button>
              <button v-else type="button" class="btn-inactivo f-12" @click="cambiarEstado(data)" >Inactivo</button>
            </td>
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
        <tr v-else>
          <td><span>No hay datos a mostrar</span></td>
        </tr>
      </table>
    </div>
  </div>

  <modal-eliminar ref="modalEliminar"
  titulo="eliminar impresora"
  :cuerpo="`¿Seguro desea eliminar pantalla con la placa ${eliminarPant.placa}?`"
  @eliminar="eliminandoImpresora"
  />

  <modal-crear ref="modalRegistrarPantalla" :ruta="ruta"
  @impresora:creada="listar_pantallas"
  :encargados="encargados" :proveedores="proveedores"/>

  <modal-editar ref="modalEditarPantalla" :ruta="ruta"
  @impresora:editada="listar_pantallas"
  :encargados="encargados" :proveedores="proveedores"/>

  <modal-crear-evento ref="modalRegistrarEvento" :ruta="ruta" :tiposEventos="tiposEventos"/>

</section>
</template>
<script>
export default {
  name: "",
  components:{
    ModalCrear:()=> import('./componentes/modalRegistrarPantalla'),
    ModalEditar:()=> import('./componentes/modalEditarPantalla'),
    ModalCrearEvento:()=> import('./componentes/modalCrearEvento'),
  },
  data(){
    return{
      ruta:'/api/pantalla',
      pantallas:[],
      search: '',
      encargados:[],
      proveedores:[],
      eliminarPant:'',
      tiposEventos:[],
      isLoading:false
    }
  },
  mounted(){
    this.isLoading = true;
    Promise.all([
      this.listar_pantallas(),
      this.listarEncargados(),
      this.listarProveedores(),
      this.eventosTipos(),
    ]).then(res=>{
      this.isLoading = false
    })
  },
  computed:{
    listadoPantallas(){
      return this.pantallas.filter(data => !this.search || data.placa.toLowerCase().includes(this.search.toLowerCase()))
    }
  },
  methods: {
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
        this.listar_pantallas()
      } catch (e) {
        console.warn(e);
      }
    },
    async eliminandoImpresora(){
      try {
        const {data} = await axios.delete(`${this.ruta}/${this.eliminarPant.id}/eliminar-pantalla`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al eliminar pantalla',data.error)
          return
        }
        this.$Helper.notificacion('success','Eliminado Correctamente',data.mensaje)

      } catch (e) {
        console.warn(e);
      } finally {
        this.listar_pantallas()
        this.$refs.modalEliminar.toggle()
      }
    },

    async listar_pantallas(){
      try {
        const {data} = await axios(`${this.ruta}/listar-pantallas`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar',data.error)
          return
        }
        this.pantallas = data
      } catch (e){
        console.warn(e);
      }
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
    modalEliminar(dato){
      this.eliminarPant = dato
      this.$refs.modalEliminar.toggle()
    },
    modalRegistrarPantalla(){
      this.$refs.modalRegistrarPantalla.toggle()
    },
    modalEditar(dato){
      this.$refs.modalEditarPantalla.toggle(dato)
    }
  }
}
</script>
<style lang="scss" scoped>
.lista-pantallas{
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
  .btn-activo{
    border: solid 1px #05580c;
    border-radius: 4px;
    padding: 1px;
    font-size: 13px;
    color: white;
    background-color: #05580c;
  }
  .btn-inactivo{
    border: solid 1px #7b0505;
    border-radius: 4px;
    padding: 1px;
    font-size: 13px;
    color: white;
    background-color: #7b0505;
  }
}
</style>
