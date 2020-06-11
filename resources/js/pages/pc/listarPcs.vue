<template>
  <section class="listar-pcs">
    <encabezado-datos tituloEncabezado="Lista de PC´s" tituloBoton="registrar pc" @accionBonton="crear_pc"/>
    <div class="row w-100 mt-4">
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
              <th>Placa</th>
              <th>Serial</th>
              <th>Encargado</th>
              <th>Proveedor</th>
              <th>Fecha Registro</th>
              <th colspan="3">Acciones</th>
            </tr>
          </thead>
          <tr v-for="(data,i) in listadoImpresoras" :key="i">
            <td>{{i + 1}}</td>
            <td><span class="letra-capital">{{data.marca}}</span></td>
            <td>{{data.placa}}</td>
            <td>{{data.serial}}</td>
            <td><span class="letra-capital">{{data.id_encargado}}</span></td>
            <td><span class="letra-capital">{{data.id_proveedor}}</span></td>
            <td>{{data.created_at}}</td>
            <td>
              <el-popover placement="bottom" title="Observaciones" width="250" trigger="hover"
              :content="data.observaciones">
              <span slot="reference" class="mdi mdi-alert-circle-outline f-20 btnDescrip "></span>
              </el-popover>
            </td>
            <td>
              <i class="mdi mdi-pencil f-18 acciones btnEditar" @click="modalEditar(data)"></i>
            </td>
            <td>
              <i class="mdi mdi-delete f-18 acciones btnEliminar" @click="modalEliminar(data)"></i>
            </td>
          </tr>
        </table>
      </div>
    </div>

    <modal-eliminar ref="modalEliminar"
    titulo="eliminar impresora"
    :cuerpo="`¿Seguro desea eliminar impresora con la placa ${eliminarPc.placa}?`"
    @eliminar="eliminandoPc"
    />

    <modal-crear ref="modalCrearPc" :ruta="ruta"
    @pc:creado="listar_pc"
    :encargados="encargados" :proveedores="proveedores"/>

    <modal-editar ref="modalEditarPc" :ruta="ruta"
    @pc:editado="listar_pc"
    :encargados="encargados" :proveedores="proveedores"/>

  </section>
</template>

<script>
export default {
  components:{
    ModalCrear:()=> import('./componentes/modalRegistrarPc'),
    ModalEditar:()=> import('./componentes/modalEditarPc')
  },
  data(){
    return{
      ruta:'/api/pc',
      pcs:[],
      search: '',
      encargados:[],
      proveedores:[],
      eliminarPc:'',
    }
  },
  mounted(){
    this.listar_pc()
    this.listarEncargados()
    this.listarProveedores()
  },
  computed:{
    listadoImpresoras(){
      return this.pcs.filter(data => !this.search || data.marca.toLowerCase().includes(this.search.toLowerCase()))
    }
  },
  methods:{
    async eliminandoPc(){
      try {
        const {data} = await axios.delete(`${this.ruta}/${this.eliminarPc.id}/eliminar-pc`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al eliminar impresora',data.error)
          return
        }
        this.$Helper.notificacion('success','Eliminado Correctamente',data.mensaje)

      } catch (e) {
        console.warn(e);
      } finally {
        this.listar_pc()
        this.$refs.modalEliminar.toggle()
      }
    },
    modalEliminar(dato){
      this.eliminarPc = dato
      this.$refs.modalEliminar.toggle()
    },
    crear_pc(){
      this.$refs.modalCrearPc.toggle()
    },
    async listar_pc(){
      try {
        const {data} = await axios(`${this.ruta}/listar-pc`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar',data.error)
          return
        }
        this.pcs = data
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
    modalEditar(dato){
      this.$refs.modalEditarPc.toggle(dato)
    }
  }
}
</script>

<style lang="scss" scoped>
.listar-pcs{
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
