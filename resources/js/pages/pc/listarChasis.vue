<template>
  <section class="listar-fuentes" v-loading="isLoading">
    <div class="mb-4 text-center">
      <h5 class="mt-4">Listado de Chasis</h5>
    </div>
    <div class="row w-100 mt-4">
      <div class="col-md-12">
        <div class="row mb-3">
          <div class="col-md-4">
            <el-input v-model="search" placeholder="Buscar..." clearable></el-input>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  components:{
    ModalCrear:()=> import('./componentes/modalFuentePoder'),
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

}
</script>

<style lang="scss" scoped>
.listar-fuentes{

}
</style>
