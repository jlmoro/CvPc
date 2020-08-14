<template>
  <section class="listar-equipos" v-loading="isLoading">
    <div class="mb-4 text-center">
      <h5 class="mt-4">Listado de Equipos</h5>
    </div>

    <div class="row w-100 mt-4">
      <div class="col-md-12">
        <div class="row mb-3 justify-content-center">
          <div class="col-md-4">
            <el-input v-model="search" placeholder="Buscar..." clearable></el-input>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4 mt-2 mb-4" v-for="(data,e) in dataEquipos" :key="e">

          <b-card no-body style="max-width: 20rem;" >
            <template v-slot:header>
              <div class="row">
                <div class="col-3">
                  <el-switch
                    style="display: block"
                    v-model="data.estado"
                    active-color="#13ce66"
                    inactive-color="#d6c9c9"
                    @change="cambio_estado(data.id)"
                    >
                  </el-switch>
                </div>
                <div class="col-3">
                  <div class="mensajes">
                    <span v-if="data.cant_comentarios > 0" class="mdi mdi-message-text f-20 icon-comentarios" @click="abrirModalComentarios(data.id,data.chasis_placa)">
                      <span class="cant-mensajes">{{data.cant_comentarios}}</span>
                    </span>
                    <span v-else class="mdi mdi-message-outline f-20 sin-comentarios" @click="abrirModalComentarios(data.id,data.chasis_placa)"></span>
                  </div>
                </div>
                <div class="col-4 text-right">
                  <i class="mdi mdi-pencil editar-equipo"></i>
                  <i class="mdi mdi-delete eliminar-equipo"></i>
                </div>
                <div class="col-2">
                  <i class="mdi mdi-calendar cal-eventos"></i>
                </div>
              </div>
            </template>

            <b-list-group flush>

              <b-list-group-item>
                <div class="row">
                  <div class="col-md-6">
                    Chasis
                  </div>
                  <div class="col-md-6">
                    <span>{{data.chasis_placa}}</span>
                  </div>
                </div>
              </b-list-group-item>

              <b-list-group-item>
                <div class="row">
                  <div class="col-md-6">
                    Board
                  </div>
                  <div class="col-md-6">
                    <span class="letra-capital">{{data.board_marca}}</span>
                  </div>
                </div>
              </b-list-group-item>

              <b-list-group-item>
                <div class="row">
                  <div class="col-md-6">
                    Procesador
                  </div>
                  <div class="col-md-6">
                    <span class="letra-capital">{{data.cpu_marca}} {{data.cpu_modelo}}</span>
                  </div>
                </div>
              </b-list-group-item>

              <b-list-group-item>
                <div class="row">
                  <div class="col-md-6">
                    RAM
                  </div>
                  <div class="col-md-6">
                    <span>16 GB</span>
                  </div>
                </div>
              </b-list-group-item>

              <b-list-group-item>
                <div class="row">
                  <div class="col-md-6">
                    SSD/HDD
                  </div>
                  <div class="col-md-6">
                    <span>1500 GB</span>
                  </div>
                </div>
              </b-list-group-item>

            </b-list-group>

            <b-card-footer>
              <div class="row">
                <div class="col-md-12 text-center">
                  <i class="mdi mdi-plus detalles-equipo" @click="abrirModalDetalles(data)"></i>
                </div>
              </div>
            </b-card-footer>

          </b-card>
        </div>
      </div>
    </div>

    <div class="overflow-auto">
      <b-pagination pills align="center"
      v-model="currentPage"
      :total-rows="total"
      :per-page="perPage"
      aria-controls="my-table"
      @change="cambioPagina($event)"
      ></b-pagination>
    </div>

    <modal-detalles ref="modalDetallesEquipos" :ruta="ruta"/>

    <modal-comentarios ref="modalComentarios" @equipo="listar_equipos"/>

  </section>

</template>

<script>
export default {
  components:{
    ModalDetalles:()=> import('./componentes/modalVerDetalles'),
    ModalComentarios:()=> import('./componentes/modalComentarios'),
  },
  data(){
    return{
      ruta:'/api/pc/equipo',
      search: '',
      isLoading:false,
      dataEquipos:[],
      value:true,
      perPage: 3,
      total:null,
      currentPage: 1,
      sumaRam:0,
      sumaDisco:0,
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
    async cambio_estado(dato){
      try {
        const {data} = await axios.put(`${this.ruta}/${dato}/cambiar-estado-equipo`)
        if (data.error) {
          this.$Helper.notificacion('warning','No es posible cambiar estado',data.error)
          return
        }
        this.$Helper.notificacion('success','Estado Actualizado',data.mensaje)
        this.listar_equipos()

      } catch (e) {
        console.warn(e);
      }
    },
    async listar_equipos(){
      const params = {
        page: this.currentPage,
        perPage: this.perPage
      }
      try {
        const {data} = await axios(`${this.ruta}/listar-equipo`,{params})
        if (data.error) {
          this.$Helper.notificacion('warning','Problemas al listar equipos',data.error)
          return
        }

        data.equipo.data.forEach((ele, i)=>{
          ele.estado == 1?ele.estado = true:ele.estado = false
        })

        this.dataEquipos = data.equipo.data
        this.perPage = data.paginate.perPage
        this.currentPage = data.paginate.currentPage
        this.total = data.paginate.total

      } catch (e) {
        console.warn(e);
      }
    },
    abrirModalComentarios(id,placa){
      this.$refs.modalComentarios.toggle(id,placa)
    },
    cambioPagina(page){
      this.currentPage = page
      this.listar_equipos()
    },
    abrirModalDetalles(dato){
      this.$refs.modalDetallesEquipos.toggle(dato)
    }
  }

}
</script>

<style lang="scss" scoped>
.listar-equipos{
  .card{
    border: 1px solid #c0c4cc !important;
    transition-duration: .85s;
    &:hover{
      box-shadow: 0px 2px 3px 1px #909399bd !important;
      transition-duration: .4s;
    }
  }
  .editar-equipo{
    border: 1px solid #b96806;
    color: #b96806;
    border-radius: 3px;
    transition-duration: .85s;
    &:hover{
      background-color: #b96806;
      color: white;
      transition-duration: .4s;
      cursor: pointer;
    }
  }
  .eliminar-equipo{
    border: 1px solid #710808;
    color: #710808;
    border-radius: 3px;
    transition-duration: .85s;
    &:hover{
      background-color: #710808;
      color: white;
      transition-duration: .4s;
      cursor: pointer;
    }
  }
  .mensajes{
    .sin-comentarios{

    }
    .icon-comentarios{
      color: darkblue;
      position: absolute;
      .cant-mensajes{
        position: relative;
        background-color: gray;
        color: darkblue;
        font-size: 11px;
        font-weight: 500;
        z-index: 100;
        right: 8px;
        bottom: 12px;
        border-radius: 6px;
        padding-left: 5px;
        padding-right: 5px;
      }
    }
    &:hover{
      cursor:pointer;
    }
  }
  .detalles-equipo, .cal-eventos{
    border: 1px solid midnightblue;
    border-radius: 3px;
    padding: 0px 1px 0px 1px;
    color: midnightblue;
    font-size: 15px;
    transition-duration: .85s;
    &:hover{
      color: white;
      background-color: midnightblue;
      cursor: pointer;
      transition-duration: .4s;
    }
  }
}
</style>
