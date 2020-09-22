<template>
  <section class="eventos-tipos" v-loading="isLoading">

    <encabezadoDatos tituloEncabezado="Perifericos" tituloBoton="nuevo periferico" @accionBonton="modalCrearPeriferico"/>

    <div class="row justify-content-center">
      <div class="col-md-7">
        <ul class="list-group">
          <li v-for="(data,e) in dataPerifericos" :key="e" class="list-group-item lista-eventos-tipos">
            <div class="row w-100">
              <div class="col-sm-2">
                <span class="cantidad f-14">{{e + 1}}</span>
              </div>
              <div class="col-sm-7">
                <span class="letra-capital">{{data.nombre}}</span>
              </div>
              <div class="col-sm-3 text-right">
                <i class="mdi mdi-pencil f-16 editar" @click="modalEditarPerifericos(data)"></i>
                <i class="mdi mdi-delete f-16 eliminar" @click="abrirModalEliminarPeriferico(data)"></i>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <modal-eliminar ref="modalEliminarPeriferico"
    titulo="eliminar periferico"
    :cuerpo="` ¿Desea eliminar el periferico '${this.eliminarPeri.nombre}' ?`"
    @eliminar="eliminarPeriferico"
    />

    <crear-tipo ref="crearPeriferico" @periferico:creado="listarPerifericos" :ruta="ruta"/>
    <editar-tipo ref="editarPeriferico" @periferico:actualizado="listarPerifericos" :ruta="ruta"/>

  </section>
</template>
<script>
export default {
  components:{
    CrearTipo:()=>import('./components/registrarPerifericos'),
    EditarTipo:()=>import('./components/editarPerifericos'),
  },
  data(){
    return{
      ruta:'/api/administrar/perifericos',
      dataPerifericos:[],
      eliminarPeri:'',
      isLoading:false,
    }
  },
  mounted() {
    this.isLoading = true
    Promise.all([
      this.listarPerifericos()
    ]).then(res => {
      this.isLoading = false
    })
  },
  methods: {
    async listarPerifericos(){
      try {
        const {data} = await axios(`${this.ruta}/listar-perifericos`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar',data.error)
          return
        }
        this.dataPerifericos = data
      } catch (e) {
          console.warn(e);
      }
    },
    async eliminarPeriferico(){
      try {
        const {data} = await axios.delete(`${this.ruta}/${this.eliminarPeri.id}/eliminar-periferico`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al eliminar',data.error)
          return
        }
        this.$refs.modalEliminarPeriferico.toggle()
        this.$Helper.notificacion('success','Eliminado',data.mensaje)
        this.listarPerifericos()
      } catch (e) {
        console.warn(e);
      }
    },
    abrirModalEliminarPeriferico(dato) {
      this.eliminarPeri = dato
      this.$refs.modalEliminarPeriferico.toggle()
    },
    modalCrearPeriferico() {
      this.$refs.crearPeriferico.toggle()
    },
    modalEditarPerifericos(dato) {
      this.$refs.editarPeriferico.toggle(dato)
    }
  }
}
</script>
<style lang="scss" scoped>
.eventos-tipos{
  .cantidad{
    padding: 0px 4px 0px 4px;
    border: solid 1px midnightblue;
    border-radius: 3px;
    color: midnightblue;
  }
  .eliminar, .editar{
    border: solid 1px midnightblue;
    border-radius: 3px;
    padding: 1px 2px 1px 2px;
    color: midnightblue;
    &:hover{
      cursor: pointer;
    }
  }
  .lista-eventos-tipos{
    &:hover{
      background: midnightblue;
      color: white;
      .eliminar, .editar, .cantidad{
        border: solid 1px white;
        color: white;
      }
    }

  }
}
</style>
