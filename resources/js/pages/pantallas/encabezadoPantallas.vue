<template >
  <section v-loading="isLoading">

  <div class="mb-5">
    <b-tabs content-class="mt-3" align="center" >
      <b-tab v-for="(data,a) in pantallas" :key="a" @click="cambioPagina(data)">
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
      pantallas:[
        {
          icono: "mdi mdi-television-guide",
          nombre: "Pantallas",
          ruta: "pantallas.listar"
        },
        {
          icono: "mdi mdi-calendar-text",
          nombre: "Eventos Pantallas",
          ruta: "eventos.pantallas"
        }
      ],
      isLoading: false,
    }
  },
  mounted(){
    this.isLoading = true
    Promise.all([
      // this.primerTab()
    ]).then(res => {
      this.isLoading = false
    })
  },
  methods: {
    primerTab(){
      let dato = _.head(this.impresora)
      this.$router.push({
        name:dato.ruta
      })
    },
    cambioPagina(data) {
      this.$router.push({
        name:data.ruta
      })
    },
  }
}
</script>

<style lang="scss" scoped>

</style>
