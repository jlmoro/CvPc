<template>
  <section class="listar-fuentes" v-loading="isLoading">

    <encabezadoDatos tituloEncabezado="Listado de Chasís" tituloBoton="registrar chasís" @accionBonton="modalRegistrarChasis"/>

    <div class="row w-100 mt-4">
      <div class="col-md-12">
        <div class="row mb-3">
          <div class="col-md-4">
            <el-input v-model="search" placeholder="Buscar..." clearable></el-input>
          </div>
        </div>
      </div>
    </div>

    <modal-crear ref="modalRegistroChasis" />

  </section>
</template>

<script>
export default {
  components:{
    ModalCrear:()=> import('./componentes/modalRegistrarChasis'),
    ModalEditar:()=> import('./componentes/modalEditarFuentePoder')
  },
  data(){
    return{
      ruta:'/api/pc/fuente',
      search: '',
      isLoading:false,
    }
  },
  mounted(){
    this.isLoading = true
    Promise.all([
      // this.listar_fuente(),
    ]).then(res => {
      this.isLoading = false
    })
  },
  methods: {
    modalRegistrarChasis(){
      this.$refs.modalRegistroChasis.toggle()
    }
  }

}
</script>

<style lang="scss" scoped>
.listar-fuentes{

}
</style>
