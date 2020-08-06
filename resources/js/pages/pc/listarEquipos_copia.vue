<template>
  <section class="listar-equipos" v-loading="isLoading">
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

    <div class="container">
      <div class="row w-100" >
        <div class="col-md-12">
          <div class="row w-100 mb-5">
            <div class="col-md-4" v-for="(data,e) in 4" :key="e">
              <div class="card-padre mt-4">
                <div class="row w-100 card-header m-0 p-0">
                  <div class="col-md-6">
                    <i class="mdi mdi-calendar"></i>
                  </div>
                  <div class="col-md-6">
                    <i class="mdi mdi-pencil"></i>
                    <i class="mdi mdi-delete"></i>
                  </div>
                </div>
                <div class="row w-100 card-body m-0 p-0">
                  <div class="col-md-12 p-0">
                    <table class="w-100">
                      <tr>
                        <td class="f-14 lado-iz-body">Placa</td>
                        <td class="f-12 text-center"><span>PLAKAA</span></td>
                      </tr>
                      <tr>
                        <td class="f-14 lado-iz-body">Board</td>
                        <td class="f-12 text-center"><span>Asus</span></td>
                      </tr>
                      <tr>
                        <td class="f-14 lado-iz-body">Procesador</td>
                        <td class="f-12 text-center"><span>Intel core i3</span></td>
                      </tr>
                      <tr>
                        <td class="f-14 lado-iz-body">RAM</td>
                        <td class="f-12 text-center"><span>16gb</span></td>
                      </tr>
                      <tr>
                        <td class="f-14 lado-iz-body">HDD - SSD</td>
                        <td class="f-12 text-center"><span>1500 GB</span></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="row w-100 card-footer m-0 p-0">
                  <div class="col-md-12 text-center p-0 m-0">
                    <i class="mdi mdi-plus detalles-equipo"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
</template>

<script>
export default {
  components:{
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
.listar-equipos{
  .card-padre{
    border: 1px solid black;
    width: 249px;
    min-width: 249px;
    .card-body{
      .lado-iz-body{
        border-right: 1px solid black;
      }
    }
    .detalles-equipo{
      border: 1px solid midnightblue;
      border-radius: 3px;
      padding: 0px 1px 0px 1px;
      color: midnightblue;
      font-size: 15px;
    }
  }
}
</style>
