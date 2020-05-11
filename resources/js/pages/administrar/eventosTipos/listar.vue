<template>
  <section class="eventos-tipos">

    <encabezadoDatos tituloEncabezado="Tipos Eventos" tituloBoton="nuevo tipo" @accionBonton="modalCrearTipoEvento"/>

    <div class="row justify-content-center">
      <div class="col-md-7">
        <ul class="list-group">
          <li v-for="(data,e) in dataEventosTipos" :key="e" class="list-group-item lista-eventos-tipos">
            <div class="row w-100">
              <div class="col-sm-2">
                <span class="cantidad f-14">{{e + 1}}</span>
              </div>
              <div class="col-sm-7">
                <span class="letra-capital">{{data.nombre_tipo}}</span>
              </div>
              <div class="col-sm-3 text-right">
                <i class="mdi mdi-pencil f-16 editar" @click="modalEditarTipoEvento(data)"></i>
                <i class="mdi mdi-delete f-16 eliminar" @click="abrirModalEliminarTipo(data)"></i>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <modal-eliminar ref="modalEliminarTipoE"
    titulo="eliminar tipo evento"
    :cuerpo="` ¿Desea eliminar el tipo de evento '${this.eliminarTipo.nombre_tipo}' ?`"
    @eliminar="eliminarTipoEvento"
    />

    <crear-tipo ref="crearTipoEvento" @eventoTipo:creado="listarEventosTipos" :ruta="ruta"/>
    <editar-tipo ref="editarTipoEvento" @eventoTipo:actualizado="listarEventosTipos" :ruta="ruta"/>

  </section>
</template>
<script>
export default {
  components:{
    CrearTipo:()=>import('./components/crearTipoEvento'),
    EditarTipo:()=>import('./components/editarTipoEvento'),
  },
  mounted() {
    this.listarEventosTipos()
  },
  data(){
    return{
      ruta:'/api/administrar/eventos-tipos',
      dataEventosTipos:[],
      eliminarTipo:''
    }
  },
  methods: {
    async listarEventosTipos(){
      try {
        const {data} = await axios(`${this.ruta}/listar-eventos`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar',data.error)
          return
        }
        this.dataEventosTipos = data
      } catch (e) {
          console.warn(e);
      }
    },
    async eliminarTipoEvento(){
      try {
        const {data} = await axios.delete(`${this.ruta}/${this.eliminarTipo.id}/eliminar-evento-tipo`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al eliminar',data.error)
          return
        }
        this.$refs.modalEliminarTipoE.toggle()
        this.$Helper.notificacion('success','Eliminado',data.mensaje)
        this.listarEventosTipos()
      } catch (e) {
        console.warn(e);
      }
    },
    abrirModalEliminarTipo(dato) {
      this.eliminarTipo = dato
      this.$refs.modalEliminarTipoE.toggle()
    },
    modalCrearTipoEvento() {
      this.$refs.crearTipoEvento.toggle()
    },
    modalEditarTipoEvento(dato) {
      this.$refs.editarTipoEvento.toggle(dato)
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
