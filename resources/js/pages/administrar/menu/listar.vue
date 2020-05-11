<template>
  <section class="listar-menu">
    <div id="">

    </div>
  </section>
</template>
<script>
export default {
  name: "",
  data(){
    return{
      ruta:"/api/menu-principal",
      dataMenu:[],
    }
  },
  mounted() {
    this.listarMenu()

  },
  methods: {
    async listarMenu(){
      try {
        const {data} = axios(`${this.ruta}/listar-menu`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar',data.error)
          return
        }
        this.dataMenu = data
      } catch (e) {
        console.warn(e);
      }
    }
  }
}
</script>
<style lang="scss" scoped>
.listar-menu{

}
</style>
