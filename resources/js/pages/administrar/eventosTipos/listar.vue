<template>
  <section class="eventos-tipos">
    <encabezadoDatos tituloEncabezado="Listar Tipos Eventos" tituloBoton="boton prueba" @accionBonton="modalCrearTipoEvento"/>

    <crear-tipo ref="crearTipoEvento"/>
    <crear-tipo ref="crearTipoEvento"/>
  </section>
</template>
<script>
export default {
  name: "",
  components:{
    CrearTipo:()=>import('./components/crearTipoEvento'),
    EditarTipo:()=>import('./components/editarTipoEvento'),
  },
  data(){
    return{

    }
  },
  methods: {
    modalCrearTipoEvento() {
      this.$refs.crearTipoEvento.toggle()
    }
  }
}
</script>
<style lang="scss" scoped>
.eventos-tipos{

}
</style>
