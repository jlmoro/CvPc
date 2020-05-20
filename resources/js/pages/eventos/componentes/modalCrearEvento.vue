<template>
  <section class="modal-crear-evento">
    <modal-b ref="modalCrearEvento">
      <div slot="header" class="row">
        <div class="col-12">
          <h5>Registrar Evento</h5>
        </div>
      </div>
      <div slot="body" class="">
        <p>lo del cuerpo</p>
      </div>

      <div slot="footer" class="">
        <button type="button" class="btn-crear" >Registrar</button>
        <button type="button" class="btn-cancelar">Cancelar</button>
      </div>
    </modal-b>
  </section>
</template>

  <script>
  export default {
    data(){
      return{

      }
    },
    methods:{
      toggle(){
        this.$refs.modalCrearEvento.toggle()
      }
    }
  }
  </script>

  <style lang="scss" scoped>

  </style>
