<template>
  <section class="encabezado-pc" v-loading="isLoading">
    <div class="mb-5 text-center">
      <h5>Equipo</h5>
    </div>

    <div class="mb-5">
      <b-tabs content-class="mt-3" justified >
        <b-tab v-for="(data,a) in torre" :key="a" :active="active" @click="cambioPagina(data)">
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
  name: "encabezadoPc",
  data(){
    return{
      active: false,
      model: null,
      isLoading: false,
      torre:[
        {
          icono: "mdi mdi-desktop-tower",
          nombre: "Chasis",
          ruta: "chasis.listar"
        },
        {
          icono: "mdi mdi-desktop-classic",
          nombre: "Registrar Equipo",
          ruta: "equipo.registrar"
        },
        {
          icono: "mdi mdi-ballot",
          nombre: "Equipos",
          ruta: "equipos.listar"
        },
        {
          icono: "mdi mdi-calendar-text",
          nombre: "Eventos Torre",
          ruta: "eventospc.listar"
        }
      ],
    }
  },
  mounted(){
    this.isLoading = true
    Promise.all([
      // this.primerTab()
      this.isActive()
    ]).then(res => {
      this.isLoading = false
    })
  },
  methods: {
    isActive(){
      // _.forEach(this.torre,(value, key)=> {
      //   if (value.ruta === this.$route.name) {
      //     this.active = true
      //   }else {
      //     this.active = false
      //   }
      // })

      this.torre.forEach((item, i) => {
        (item.ruta == this.$route.name)?this.active = true:this.active = false
      });

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
