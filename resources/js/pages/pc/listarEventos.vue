<template>
  <section class="listar-eventos-pc" v-loading="isLoading">
    <div class="mb-4 text-center">
      <h5 class="mt-4">Lisado de Eventos PC</h5>
    </div>

    <div class="row w-100">
      <div class="col-md-12">
        <table class="table" id="my-table">
          <thead class="thead-light text-center f-13">
            <th>#</th>
            <th>Marca Chasis</th>
            <th>Placa Chasis</th>
            <th>Encargado</th>
            <th>Proveedor</th>
            <th>Fecha Registro</th>
            <th>Estado</th>
            <th colspan="4">Acciones</th>
          </thead>
          <tbody class="text-center f-12">
            <tr v-for="(data,t) in dataEventosPc" :key="t">
              <td>{{ t + 1}}</td>
              <td><span class="letra-capital">{{data.chasis_marca}}</span></td>
              <td>{{data.chasis_placa}}</td>
              <td><span class="letra-capital">{{data.encargado_nombre}}</span></td>
              <td><span class="letra-capital">{{data.proveedor_nombre}}</span></td>
              <td>{{data.created_at | formato_fecha('D-MM-YYYY')}}</td>
              <td>
                <!-- <button v-if="data.estado == 1" type="button" class="btn-estado-act" @click="cambiarEstado(data)">Activo</button> -->
                <!-- <button v-else type="button" class="btn-estado-inact" @click="cambiarEstado(data)">Inactivo</button> -->
              </td>
              <td>
                <i class="mdi mdi-information-outline f-16 mr-3"></i>
                <i class="mdi mdi-pencil acciones btn-editar"></i>
                <i class="mdi mdi-delete acciones btn-delete"></i>
                <i class="mdi mdi-calendar btn-evento ml-2"></i>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="overflow-auto">
          <b-pagination pills align="center"
          v-model="currentPage"
          :total-rows="total"
          :per-page="perPage"
          aria-controls="my-table"
          @change="cambioPagina($event)"
          ></b-pagination>
        </div>

      </div>
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
    cambioPagina(){

    },
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
