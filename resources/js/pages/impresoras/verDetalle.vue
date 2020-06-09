<template>
  <section class="modal-detalles">
    <modal-b ref="modalVerDetalles">
      <div slot="header" class="row">
        <div class="col-12">
          <h5>Detalles Estado Evento</h5>
        </div>
      </div>
      <div slot="body" class="">
        <div class="row w-100 mb-3">
          <div class="col-md-6">
            <label for="">Fecha Resolver:</label><br>
            <span class="f-18 texto-info">{{verDetalle.evento_fecha_resolver}}</span>
          </div>
          <div class="col-md-6">
            <label for="">Pesona Asignada:</label><br>
            <span class="f-18 texto-info">{{verDetalle.nombre_usuario_asignado}} {{verDetalle.apellido_usuario_asignado}}</span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="">Estado Evento:</label><br>
            <span v-show="verDetalle.evento_estado == 2" class="f-18 texto-info">Asignado</span>
            <span v-show="verDetalle.evento_estado == 3" class="f-18 texto-info">Resuelto</span>
          </div>
          <div class="col-md-6">
            <label for="">Area:</label><br>
            <span class="f-18 texto-info">{{verDetalle.evento_area}}</span>
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
      // console.log(dato,"desde el modal detalle");
      this.verDetalle = _.cloneDeep(dato)
      this.$refs.modalVerDetalles.toggle()
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
