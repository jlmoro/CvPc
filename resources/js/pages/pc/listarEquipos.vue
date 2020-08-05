<template>
  <section class="listar-fuentes" v-loading="isLoading">

    <div class="mb-4 text-center">
      <h5 class="mt-4">Listado de Equipos</h5>
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
      ruta:'/api/pc/equipo',
      search: '',
      isLoading:false,
      dataEquipos:[],
    }
  },
  mounted(){
    this.isLoading = true
    Promise.all([
      this.listar_equipos(),
    ]).then(res => {
      this.isLoading = false
    })
  },
  methods: {
    async listar_equipos(){
      try {
        const {data} = await axios(`${this.ruta}/listar-equipo`)
        if (data.error) {
          this.$Helper.notificacion('warning','Problemas al listar equipos',data.error)
          return
        }

        this.dataEquipos = data

      } catch (e) {
        console.warn(e);
      }
    }
  }

}
</script>

<style lang="scss" scoped>
.listar-fuentes{

}
</style>
