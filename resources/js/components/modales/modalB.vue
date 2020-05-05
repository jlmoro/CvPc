<template>
  <section class="modal-principal">
    <div ref="modalB" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <!-- <button type="button" >
          </button> -->
          <span aria-hidden="true" class="close" data-dismiss="modal" aria-label="Close">&times;</span>

          <div class="modal-header">
            <div class="row w-100">
              <div class="col-md-12 text-center">
                <slot name="header">
                  Titulo
                </slot>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <slot name="body">
              default body
            </slot>
          </div>
          <div class="modal-footer justify-content-center">
            <slot name="footer">
              default footer
              <button class="btn-secondary" @click="toggle">
                Cerrar
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
  name:'ModalB',
  data(){
    return{

    }
  },
  methods:{
    toggle(){
      $(this.$refs.modalB).modal('toggle');
    }
  }
}
</script>

<style lang="scss" scoped>
.modal-principal{
  .close{
    position: absolute;
    right: -8px;
    top: -13px;
    border-radius: 50%;
    background-color: #441d5d;
    color: white !important;
    font-weight: 100 !important;
    padding-left: 7px;
    padding-right: 7px;
    padding-bottom: 7px;
    opacity: 0.75;
    transition-duration: 0.5s;
    cursor: pointer;
    &:hover{
      opacity: 3.75;
      transition-duration: 0.5s;
    }
  }
}
</style>
