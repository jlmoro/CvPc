<template>
  <section class="listar-impresoras">
    <encabezado-datos tituloEncabezado="Impresoras" tituloBoton="registrar impresora" @accionBonton="crear_impresora"/>
    <div class="row w-100 mt-4">
      <div class="col-md-12">
        <!-- :data="impresoras.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))" -->
        <div class="row mb-3">
          <div class="col-md-4">
            <el-input v-model="search" placeholder="Buscar..." clearable></el-input>
          </div>
        </div>
        <table class="table table-hover">
          <thead class="thead-light">
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
            <td>{{data.marca}}</td>
            <td>{{data.placa}}</td>
            <td>{{data.serial}}</td>
            <td>{{data.id_encargado}}</td>
            <td>{{data.id_proveedor}}</td>
            <td>{{data.created_at}}</td>
            <td>
              <el-popover placement="bottom" title="Observaciones" width="250" trigger="hover"
              :content="data.observaciones">
              <span slot="reference" class="mdi mdi-alert-circle-outline"></span>
              </el-popover>
            </td>
            <td>
              <i class="mdi mdi-pencil" @click="modalEditar(data)"></i>
            </td>
            <td>
              <i class="mdi mdi-delete"></i>
            </td>
          </tr>
        </table>
      </div>
    </div>

    <modal-crear ref="modalCrearImpresora" :ruta="ruta" @impresora:creada="listar_impresoras"/>
    <modal-editar ref="modalEditarImpresora" :ruta="ruta" @impresora:editada="listar_impresoras"/>

  </section>
</template>

<script>
export default {
  components:{
    ModalCrear:()=> import('./componentes/modalRegistrarImpresora'),
    ModalEditar:()=> import('./componentes/modalEditarImpresora')
  },
  data(){
    return{
      ruta:'/api/impresora',
      impresoras:[],
      search: '',
    }
  },
  mounted(){
    this.listar_impresoras()
  },
  computed:{
    listadoImpresoras(){
      return this.impresoras.filter(data => !this.search || data.marca.toLowerCase().includes(this.search.toLowerCase()))
    }
  },
  methods:{
    crear_impresora(){
      this.$refs.modalCrearImpresora.toggle()
    },
    async listar_impresoras(){
      try {
        const {data} = await axios(`${this.ruta}/listar-impresoras`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar',data.error)
          return
        }
        this.impresoras = data
      } catch (e){
        console.warn(e);
      }
    },
    modalEditar(dato){
      this.$refs.modalEditarImpresora.toggle(dato)
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
