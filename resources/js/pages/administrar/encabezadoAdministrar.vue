<template >
  <section v-loading="isLoading">
    <h3 class="mb-2 text-center">Administrables</h3>

  <div class="mb-5">
    <b-tabs content-class="mt-3" fill >
      <b-tab v-for="(data,a) in administrar" :key="a" @click="cambioPagina(data)">
        <template v-slot:title>
          <i :class="data.icono"></i> <span>{{data.nombre}}</span>
        </template>
      </b-tab>
    </b-tabs>
    <router-view />
  </div>


</section>
</template>

<script>
export default {
  data(){
    return{
      activeName: true,
      administrar:[],
      isLoading: false,
    }
  },
  mounted(){
    this.isLoading = true
    Promise.all([
      this.listar_administrables()
    ]).then(res => {
      this.isLoading = false
    })
  },
  methods: {
    cambioPagina(data) {
      this.$router.push({
        name:data.ruta
      })
    },

    async listar_administrables(){
      try {
        const {data} = await axios(`/api/administrar/listar-administrar`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error administrables',data.error)
          return
        }
        this.administrar = data
        
        let dato = _.head(data)
        this.$router.push({
          name:dato.ruta
        })

      } catch (e) {
        console.warn(e,"error listar administrables");
      }
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
