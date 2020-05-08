<template>
  <section class="eventos-tipos">

    <encabezadoDatos tituloEncabezado="Tipos Eventos" tituloBoton="nuevo tipo" @accionBonton="modalCrearTipoEvento"/>

    <div class="row">
      <div class="col-md-12">
        <ul class="list-group">
          <li v-for="(data,e) in dataEventosTipos" :key="e" class="list-group-item active">
            {{data.nombre_tipo}}
          </li>
        </ul>
      </div>
    </div>

    <crear-tipo ref="crearTipoEvento" @eventoTipo:creado="listarEventosTipos" :ruta="ruta"/>
    <editar-tipo ref="editarTipoEvento" @eventoTipo:actualizado="listarEventosTipos"/>

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
    }
  },
  methods: {
    async listarEventosTipos(){
      const {data} = await axios(`${this.ruta}/listar-eventos`)
      if (data.error) {
        this.$Helper.notificacion('warning','Error al listar',data.error)
        return
      }
      this.dataEventosTipos = data
    },
    modalCrearTipoEvento() {
      this.$refs.crearTipoEvento.toggle()
    },
    modalEditarTipoEvento() {
      this.$refs.crearTipoEvento.toggle()
    }
  }
}
</script>
<style lang="scss" scoped>
.eventos-tipos{
}
</style>
