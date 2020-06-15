<template>
  <section class="listar-discos" v-loading="isLoading">
    <encabezado-datos tituloEncabezado="Disco SSD/HDD" tituloBoton="registrar disco" @accionBonton="crear_memoria"/>
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
              <th>Modelo/Tecnología</th>
              <th>Capacidad</th>
              <th>Frecuencia</th>
              <th>Serial</th>
              <th>Fecha Registro</th>
              <th colspan="3">Acciones</th>
            </tr>
          </thead>
          <tr v-for="(data,i) in listadoDiscos" :key="i">
            <td>{{i + 1}}</td>
            <td><span class="letra-capital">{{data.marca}}</span></td>
            <td class="text-center">{{data.modelo_tecnologia}}</td>
            <td class="text-center">{{data.capacidad}} GB</td>
            <td class="text-center">{{data.frecuencia}} MHz</td>
            <td v-if="data.serial !== null"><span class="letra-capital">{{data.serial}}</span></td>
            <td v-else><span class="letra-capital">no registra</span></td>
            <td>{{data.created_at | formato_fecha('DD-MMM-yyyy')}}</td>
            <td>
              <el-popover v-if="data.observaciones === null" placement="bottom" title="Observaciones" width="250" trigger="hover"
                content="Sin Observaciones">
                <span slot="reference" class="mdi mdi-alert-circle-outline f-20 btnDescrip "></span>
              </el-popover>
              <el-popover v-else placement="bottom" title="Observaciones" width="250" trigger="hover"
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
:cuerpo="`¿Seguro desea eliminar la fuente ${eliminarRam.marca} ${eliminarRam.modelo_tecnologia}
${eliminarRam.capacidad} GB?`"
@eliminar="eliminandoPc"
/>

<modal-crear ref="modalCrearFuente" :ruta="ruta" @procesador:registrado="listar_discos" />

<modal-editar ref="modalEditarPc" :ruta="ruta" @fuente:actualizada="listar_discos" />

</section>
</template>

<script>
export default {
  components:{
    ModalCrear:()=> import('./componentes/modalCrearProcesador'),
    ModalEditar:()=> import('./componentes/modalEditarProcesador')
  },
  data(){
    return{
      ruta:'/api/pc/disco',
      discos:[],
      search: '',
      eliminarRam:'',
      isLoading:false
    }
  },
  mounted(){
    this.isLoading = true
    Promise.all([
      this.listar_discos(),
    ]).then(res => {
      this.isLoading = false
    })
  },
  computed:{
    listadoDiscos(){
      return this.discos.filter(data => !this.search || data.marca.toLowerCase().includes(this.search.toLowerCase()))
    }
  },
  methods:{
    async eliminandoPc(){
      try {
        const {data} = await axios.delete(`${this.ruta}/${this.eliminarRam.id}/eliminar-fuente`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al eliminar impresora',data.error)
          return
        }
        this.$Helper.notificacion('success','Eliminado Correctamente',data.mensaje)
        this.listar_discos()
        this.$refs.modalEliminar.toggle()

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
        this.listar_discos()
      } catch (e) {
        console.warn(e);
      }
    },
    modalEliminar(dato){
      this.eliminarRam = dato
      this.$refs.modalEliminar.toggle()
    },
    crear_memoria(){
      this.$refs.modalCrearFuente.toggle()
    },
    async listar_discos(){
      try {
        const {data} = await axios(`${this.ruta}/listar-discos`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar',data.error)
          return
        }
        this.discos = data
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
.listar-discos{
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
