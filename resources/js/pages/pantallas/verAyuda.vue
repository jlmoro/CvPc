<template>
  <section class="modal-detalles">
    <modal-b ref="modalVerAyuda">
      <div slot="header" class="row">
        <div class="col-12">
          <h5>Información de Ayuda</h5>
        </div>
      </div>
      <div slot="body" class="text-center">
        <span class="text-center" v-if="verAyuda.solucion_ayuda !== null">{{verAyuda.solucion_ayuda}}</span>
        <span class="text-center" else> No se ha registrado comentario de ayuda</span>
      </div>
      <div slot="footer" class="">
        <!-- <button type="button" class="btn-crear" @click="registrarEvento">Registrar</button> -->
        <button type="button" class="btn-crear" data-dismiss="modal">Aceptar</button>
      </div>
    </modal-b>
  </section>
</template>

<script>
export default {
  data(){
    return{
      verAyuda:{},
    }
  },
  methods: {
    toggle(dato){
      // console.log(dato,"desde el modal detalle");
      this.verAyuda = _.cloneDeep(dato)
      this.$refs.modalVerAyuda.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
.modal-detalles{
  .texto-info{
    border: solid 1px lightgray;
    padding: 3px 10px 3px 7px;
    border-radius: 3px;
    color: gray;
  }
}
</style>
