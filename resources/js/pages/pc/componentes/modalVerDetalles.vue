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
            <table class="table table-bordered tabla-info">
              <thead>
                <th>Chasis</th>
                <th>Procesador</th>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="row">
                      <div class="col"> Placa: </div>
                      <div class="col"> {{equipo.chasis_placa}} </div>
                    </div>
                  </td>
                  <td>
                    <div class="row">
                      <div class="col"> Marca: </div>
                      <div class="col"> {{equipo.cpu_marca}} </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="row">
                      <div class="col"> Marca: </div>
                      <div class="col"> {{equipo.chasis_marca}} </div>
                    </div>
                  </td>
                  <td>
                    <div class="row">
                      <div class="col"> Modelo: </div>
                      <div class="col"> {{equipo.cpu_modelo}} </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="row">
                      <div class="col"> Serial: </div>
                      <div class="col"> {{equipo.chasis_serial}} </div>
                    </div>
                  </td>
                  <td>
                    <div class="row">
                      <div class="col"> Núcleos: </div>
                      <div class="col"> {{equipo.cpu_nucleos}} </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <div class="row">
                      <div class="col"> Frecuencia: </div>
                      <div class="col"> {{equipo.cpu_frecuencia}} Ghz</div>
                    </div>
                  </td>
                </tr>
              </tbody>
              <thead>
                <th>Board</th>
                <th>Fuente</th>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="row">
                      <div class="col"> Marca: </div>
                      <div class="col"> {{equipo.board_marca}} </div>
                    </div>
                  </td>
                  <td>
                    <div class="row">
                      <div class="col"> Marca: </div>
                      <div class="col"> {{equipo.fuente_marca}} </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="row">
                      <div class="col"> Modelo: </div>
                      <div class="col"> {{equipo.board_modelo}} </div>
                    </div>
                  </td>
                  <td>
                    <div class="row">
                      <div class="col"> Modelo: </div>
                      <div class="col"> {{equipo.fuente_modelo}} </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="row">
                      <div class="col"> PCI: </div>
                      <div class="col"> {{equipo.board_pci}} </div>
                    </div>
                  </td>
                  <td>
                    <div class="row">
                      <div class="col"> Potencia: </div>
                      <div class="col"> {{equipo.fuente_potencia}} W</div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="row">
                      <div class="col"> PCIX: </div>
                      <div class="col"> {{equipo.board_pcix}} </div>
                    </div>
                  </td>
                  <td>
                    <div class="row">
                      <div class="col"> Alimentador: </div>
                      <div class="col"> {{equipo.fuente_alimentador}} pines </div>
                    </div>
                  </td>
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
    async descargaPdf(){

      try {
        window.open(`${this.ruta}/descarga-pdf-detalles-equipo`)

      } catch (e) {
        console.warn(e);
      }
    },
    toggle(dato){
      this.equipo = _.cloneDeep(dato)
      console.log(this.equipo);
      this.$refs.ModalDetallesEquipo.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
.modalDetalles-equipo{
  .tabla-info{
    width: 107%;
  }
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
