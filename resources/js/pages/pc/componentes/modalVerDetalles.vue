<template>
  <section class="modalDetalles-equipo">
    <modal ref="ModalDetallesEquipo">
      <div slot="header" class="row">
        <div class="col-11 pr-0">
          <h5>Detalles Equipo - {{equipo.chasis_placa}}</h5>
        </div>
        <div class="col-1 pl-0">
          <i class="mdi mdi-adobe-acrobat icono-pdf"></i>
        </div>
      </div>
      <div slot="body" class="row w-100">
        <div class="col-12">
          <div class="container">
            <table>
              <tbody>
                <tr>
                  <td>Chasis:</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div slot="footer" class="row">
        <div class="col-12">
          <button type="button" class="btn-crear" data-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </modal>
  </section>
</template>

<script>
export default {
  props: [
    'ruta',
  ],
  components:{
    Modal:()=> import('~/components/modales/modalB')
  },
  data(){
    return{
      equipo:{},
    }
  },
  methods:{

    toggle(dato){
      this.equipo = _.cloneDeep(dato)
      this.$refs.ModalDetallesEquipo.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
.modalDetalles-equipo{
  .icono-pdf{
    border: 1px solid #710606e6;
    border-radius: 2px;
    padding: 3px;
    font-size: 16px;
    color: white;
    background-color: #710606e6;
    transition-duration: .85s;
    &:hover{
      color: #710606e6;
      background-color: white;
      transition-duration: .4s;
      cursor: pointer;
    }
  }
}
</style>
