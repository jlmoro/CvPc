<template>
  <section class="listar-eventos-pc" v-loading="isLoading">
    <div class="mb-4 text-center">
      <h5 class="mt-4">Lisado de Eventos PC</h5>
    </div>
  </section>
</template>
<script>
export default {
  name: "",
  data(){
    return{
      ruta:'/api/pc/equipo/eventos',
      isLoading:false,
      dataEventosPc:[],
      perPage: 5,
      total:null,
      currentPage: 1,
      options: [{
          value: 5,
          label: '5'
        }, {
          value: 10,
          label: '10'
        }, {
          value: 15,
          label: '15'
        }
      ],
    }
  },
  mounted() {
    this.isLoading = true;
    Promise.all([
      this.listar_eventos_torre(),
      // this.eventosTipos(),
      // this.listarUsuarios(),
    ]).then(res=>{
      this.isLoading = false
    })
  },
  methods: {

    async listar_eventos_torre(){
      try {
        let params = {
          page: this.currentPage,
          perPage: this.perPage
        }

        const {data} = await axios(`${this.ruta}/listar-eventos-torres`,{params})
        if (data.error) {
          this.$Helper.notificacion('warning','No es posible listar eventos',data.error)
          return
        }
        this.dataEventosPc = data.equipo.data

      } catch (e) {
        console.warn(e);
      }
    }
  }
}
</script>
<style lang="scss" scoped>
.listar-eventos-pc{

}
</style>
