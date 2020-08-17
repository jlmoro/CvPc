<template>
  <section class="modalDetalles-equipo">
    <modal ref="ModalDetallesEquipo">
      <div slot="header" class="row">
        <div class="col-11 pr-0">
          <h5>Detalles Equipo - {{equipo.chasis_placa}}</h5>
        </div>
        <div class="col-1 pl-0">
          <vs-tooltip bottom>
            <i class="mdi mdi-adobe-acrobat icono-pdf" @click="descargaPdf"></i>
            <template #tooltip>
              Generar PDF
            </template>
          </vs-tooltip>
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
              <thead>
                <th>SSD/HDD ({{equipo.sumaDisco}} GB)</th>
                <th>Memoria RAM ({{equipo.sumaRam}} GB)</th>
              </thead>
              <tbody>

                <tr class="f-14">
                  <td>
                    <div class="row" v-for="(data,d) in equipo.disco" :key="d">
                      <div v-if="equipo.disco.length > 1" class="col"> Capacidad({{d+1}}): </div>
                      <div v-else class="col"> Capacidad: </div>
                      <div class="col"> {{data.disco_capacidad}} GB</div>
                    </div>
                  </td>
                  <td>
                    <div class="row" v-for="(data,r) in equipo.ram" :key="r">
                      <div v-if="equipo.ram.length > 1" class="col"> Capacidad({{r+1}}): </div>
                      <div v-else class="col"> Capacidad: </div>
                      <div class="col"> {{data.ram_capacidad}} GB</div>
                    </div>
                  </td>
                </tr>

                <tr class="f-14">
                  <td>
                    <div class="row" v-for="(data,d) in equipo.disco" :key="d">
                      <div v-if="equipo.disco.length > 1" class="col"> Marca({{d+1}}): </div>
                      <div v-else class="col"> Marca: </div>
                      <div class="col"> {{data.disco_marca}}</div>
                    </div>
                  </td>
                  <td>
                    <div class="row" v-for="(data,r) in equipo.ram" :key="r">
                      <div v-if="equipo.ram.length > 1" class="col"> Marca({{r+1}}): </div>
                      <div v-else class="col"> Marca: </div>
                      <div class="col"> {{data.ram_marca}}</div>
                    </div>
                  </td>
                </tr>

                <tr class="f-14">
                  <td>
                    <div class="row" v-for="(data,d) in equipo.disco" :key="d">
                      <div v-if="equipo.disco.length > 1" class="col"> Modelo({{d+1}}): </div>
                      <div v-else class="col"> Modelo: </div>
                      <div v-if="data.disco_modelo" class="col"> {{data.disco_modelo}}</div>
                      <div v-else class="col"> No Registra</div>
                    </div>
                  </td>
                  <td>
                    <div class="row" v-for="(data,r) in equipo.ram" :key="r">
                      <div class="col"> Modelo/Tecnología: </div>
                      <div class="col"> {{data.ram_modelo}}</div>
                    </div>
                  </td>
                </tr>

                <tr class="f-14">
                  <td>
                    <div class="row" v-for="(data,d) in equipo.disco" :key="d">
                      <div v-if="equipo.disco.length > 1" class="col"> RPM({{d+1}}): </div>
                      <div v-else class="col"> RPM: </div>
                      <div class="col"> {{data.disco_rpm}}</div>
                    </div>
                  </td>
                  <td>
                    <div class="row" v-for="(data,r) in equipo.ram" :key="r">
                      <div v-if="equipo.ram.length > 1" class="col"> Frecuencia({{r+1}}): </div>
                      <div v-else class="col"> Frecuencia: </div>
                      <div class="col"> {{data.ram_frecuencia}} Mhz</div>
                    </div>
                  </td>
                </tr>

                <tr class="f-14">
                  <td>
                    <div class="row" v-for="(data,d) in equipo.disco" :key="d">
                      <div v-if="equipo.disco.length > 1" class="col"> Tipo({{d+1}}): </div>
                      <div v-else class="col"> Tipo: </div>
                      <div v-if="data.disco_tipo == 1" class="col"> SSD </div>
                      <div v-else class="col"> HDD </div>
                    </div>
                  </td>
                  <td>

                  </td>
                </tr>

              </tbody>
              <thead>
                <th>Área</th>
                <th>Proveedor</th>
              </thead>
              <tbody>
                <tr>
                  <td> <span class="letra-capital">{{equipo.area_nombre}}</span> </td>
                  <td><span class="letra-capital">{{equipo.nombre_proveedor}}</span></td>
                </tr>
              </tbody>
              <thead>
                <th colspan="2" class="text-center">Perifericos</th>
              </thead>
              <tbody>
                <tr >
                  <td colspan="2">
                    <div class="row justify-content-center" v-for="(data,p) in equipo.perifericos" :key="p">
                      <div class="col text-center">
                        <span class="letra-capital">{{data.periferico_nombre}}</span>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
              <thead>
                <th colspan="2" class="text-center">Encargado</th>
              </thead>
              <tbody>
                <tr>
                  <td>Documento:</td>
                  <td>{{equipo.encargado_documento}}</td>
                </tr>
                <tr >
                  <td colspan="2" class="text-center">
                    <vs-tooltip>
                      <b-avatar v-if="equipo.encargado_foto" :src="`/storage/${equipo.encargado_foto}`" size="6rem"></b-avatar>
                      <b-avatar v-else src="/img/user-default.jpg" size="6rem"></b-avatar>
                      <template #tooltip>
                        <span class="letra-capital">{{equipo.encargado_nombre}}</span>
                      </template>
                    </vs-tooltip>
                  </td>
                </tr>
              </tbody>
              <thead>
                <th colspan="2" class="text-center">Observaciones</th>
              </thead>
              <tbody>
                <tr>
                  <td colspan="2">
                    {{equipo.observaciones}}
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
        window.open(`${this.ruta}/${this.equipo.id}/descarga-pdf-detalles-equipo`)
        // const {data} = axios(`${this.ruta}/${this.equipo.id}/descarga-pdf-detalles-equipo`)

        console.log(data);

      } catch (e) {
        console.warn(e);
      }
    },
    toggle(dato){
      this.equipo = _.cloneDeep(dato)
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
