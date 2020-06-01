<template>
  <section>
    <modal-b ref="modalVerDetalles">
      <div slot="header" class="row">
        <div class="col-12">
          <h5>Detalles Estado Evento</h5>
        </div>
      </div>
      <div slot="body" class="">
        <div class="row w-100 mb-3">
          <div class="col-md-12 text-center">
            
          </div>
        </div>
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
      verDetalle:{},
    }
  },
  methods: {
    toggle(dato){
      this.verDetalle = _.cloneDeep(dato)
      console.log(this.verDetalle,"datoooooo");
      this.$refs.modalVerDetalles.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
</style>
