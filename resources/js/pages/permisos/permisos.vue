<template>
  <section class="listar-permisos">
    <div class="" v-loading="isLoading">
      <h3>Listado de Permisos</h3>

    </div>
  </section>
</template>
<script>
export default {
  data(){
    return{
      isLoading:false,
    }
  },
  mounted() {
    this.isLoading = true
    Promise.all([
      // this.listarPermisos()
    ]).then(res => {
      this.isLoading = false
    })
  },
  methods: {
    listadoPermisos() {

    }
  }

}
</script>
<style lang="scss" scoped>
.listar-permisos{
  
}
</style>
