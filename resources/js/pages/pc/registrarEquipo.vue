<template>
  <section class="registrar-equipos" v-loading="isLoading">
    <div class="mb-4 text-center">
      <h5 class="mt-4">Registrar Equipo</h5>
    </div>

  </section>
</template>

<script>
export default {
  data(){
    return{
      ruta:'/api/pc/procesador',
      search: '',
      isLoading:false,
    }
  },
  mounted(){
    this.isLoading = true
    Promise.all([
      // this.listar_procesador(),
    ]).then(res => {
      this.isLoading = false
    })
  },
  // computed:{
  //
  // },

  // methods: {
  //
  // }
}
</script>

<style lang="scss" scoped>
.registrar-equipos{

}
</style>
