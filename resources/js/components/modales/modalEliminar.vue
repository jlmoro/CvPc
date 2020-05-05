<template>
  <section class="modal-principal">
    <div ref="modalE" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <div class="row w-100">
              <div class="col-md-12 text-center">
                <slot name="header">
                  <p class="f-20">{{titulo}}</p>
                </slot>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <slot name="body">
              <div class="row w-100">
                <div class="col-md-12 text-center">
                  <p>{{cuerpo}}</p>
                </div>
              </div>
            </slot>
          </div>
          <div class="modal-footer justify-content-center">
            <slot name="footer">
              <button class="btn-eliminar" @click="$emit('eliminar')">
                Eliminar
              </button>
              <button class="btn-cancelar" @click="toggle">
                Cancelar
              </button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name:'modalEliminar',
  props: [
    'titulo',
    'cuerpo',
  ],
  data(){
    return{

    }
  },
  methods:{
    toggle(){
      $(this.$refs.modalE).modal('toggle');
    }
  }
}
</script>

<style lang="scss" scoped>
.modal-principal{

}
</style>
