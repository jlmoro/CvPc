<template>
  <section class="registrar-equipos" v-loading="isLoading">
    <div class="mb-4 text-center">
      <h5 class="mt-4">Registrar Equipo</h5>
    </div>

    <div class="container">
      <div class="row w-100">
        <div class="col-md-12">

          <div class="mb-3">
            <el-steps :active="active" align-center finish-status="success">
              <el-step title="Placa Base"></el-step>
              <el-step title="Procesador"></el-step>
              <el-step title="RAM"> </el-step>
              <el-step title="HDD/SSD"> </el-step>
              <el-step title="Fuente Poder"> </el-step>
              <el-step title="Perifericos"> </el-step>
              <el-step title="Asignar"> </el-step>
            </el-steps>
          </div>
          <!-- board -->
          <div v-show="active == 1">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="Placa Base" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >

                <b-form-group label-cols-sm="3" label="Marca:" label-align-sm="right" label-for="marca-board" >
                  <b-form-input id="marca-board" v-model="form.board.marca"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Modelo:" label-align-sm="right" label-for="modelo-board" >
                  <b-form-input id="modelo-board" v-model="form.board.modelo"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="PCI:" label-align-sm="right" label-for="pci-board" >
                  <b-form-input id="pci-board" type="number" v-model="form.board.pci"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="PCI-X:" label-align-sm="right" label-for="pcix-board" >
                  <b-form-input id="pcix-board" type="number" v-model="form.board.pcix"></b-form-input>
                </b-form-group>

              </b-form-group>
            </b-card>
          </div>

          <!-- procesador -->
          <div v-show="active == 2">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="Procesador" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >

                <b-form-group label-cols-sm="3" label="Marca:" label-align-sm="right" label-for="marca-proc" >
                  <b-form-input id="marca-proc" v-model="form.procesador.marca"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Modelo:" label-align-sm="right" label-for="modelo-proc" >
                  <b-form-input id="modelo-proc" v-model="form.procesador.modelo"></b-form-input>
                </b-form-group>

                <div class="row justify-content-end">
                  <div class="col-md-6">
                    <b-form-group label-cols-sm="4" label="Núcleos:" label-align-sm="right" label-for="nuc-proc" >
                      <b-form-input id="nuc-proc" type="number" v-model="form.procesador.nucleos"></b-form-input>
                    </b-form-group>
                  </div>
                  <div class="col-md-5">
                    <b-form-group label-cols-sm="4" label="Velocidad:" label-align-sm="right" label-for="vel-proc" >
                      <b-form-input id="vel-proc" type="number" v-model="form.procesador.velocidad"></b-form-input>
                    </b-form-group>
                  </div>
                </div>
              </b-form-group>
            </b-card>
          </div>

          <!-- RAM -->
          <div v-show="active == 3">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="Memoria RAM" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >

                <div class="row mb-2">
                  <div class="col-sm-12 text-right mb-2">
                    <i class="mdi mdi-plus mas-ram" @click="agregarRam"></i>
                  </div>
                </div>

                <div class="row" v-for="(ram,r) in form.ram" :key="r">
                  <div class="col-md-11">

                    <div class="row">
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="4" label="Marca:" label-align-sm="right" :label-for="`marca-ram-${r}`" >
                          <b-form-input :id="`marca-ram-${r}`" v-model="ram.marca"></b-form-input>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="5" label="Tecnología:" label-align-sm="right" :label-for="`tec-ram-${r}`" >
                          <b-form-input :id="`tec-ram-${r}`" v-model="ram.tecnologia"></b-form-input>
                        </b-form-group>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="4" label="Capacidad:" label-align-sm="right" :label-for="`capacidad-ram-${r}`" >
                          <b-form-input :id="`capacidad-ram-${r}`" v-model="ram.capacidad"></b-form-input>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="5" label="Velocidad:" label-align-sm="right" :label-for="`velocidad-ram-${r}`" >
                          <b-form-input :id="`velocidad-ram-${r}`" type="number" v-model="ram.velocidad"></b-form-input>
                        </b-form-group>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <b-form-group label-cols-sm="2" label="Serial:" label-align-sm="right" :label-for="`serial-ram-${r}`" >
                          <b-form-input :id="`serial-ram-${r}`" v-model="ram.serial"></b-form-input>
                        </b-form-group>
                      </div>
                    </div>

                    <hr>

                  </div>
                  <div class="col-md-1">
                    <i class="mdi mdi-delete menos-ram" @click="menosRam(r)"></i>
                  </div>

                </div>



              </b-form-group>
            </b-card>
          </div>

          <!-- HDD/SSD -->
          <div v-show="active == 4">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="HDD/SSD" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >
                <div class="row mb-2">
                  <div class="col-sm-12 text-right mb-2">
                    <i class="mdi mdi-plus mas-ram" @click="agregarDisco"></i>
                  </div>
                </div>
                <div class="row" v-for="(disco,d) in form.disco" :key="d">
                  <div class="col-md-11">

                    <div class="row">
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="4" label="Marca:" label-align-sm="right" :label-for="`marca-disco-${d}`" >
                          <b-form-input :id="`marca-disco-${d}`" v-model="disco.marca"></b-form-input>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="5" label="Capacidad:" label-align-sm="right" :label-for="`cap-disco-${d}`" >
                          <b-form-input :id="`cap-disco-${d}`" v-model="disco.capacidad"></b-form-input>
                        </b-form-group>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="4" label="Modelo:" label-align-sm="right" :label-for="`modelo-disco-${d}`" >
                          <b-form-input :id="`modelo-disco-${d}`" v-model="disco.modelo"></b-form-input>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="5" label="Tecnología:" label-align-sm="right" :label-for="`tecno-disco-${d}`" >
                          <b-form-input :id="`tecno-disco-${d}`" v-model="disco.tecnologia"></b-form-input>
                        </b-form-group>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="4" label="RPM:" label-align-sm="right" :label-for="`rpm-disco-${d}`" >
                          <b-form-input :id="`rpm-disco-${d}`" type="number" v-model="disco.rpm"></b-form-input>
                        </b-form-group>
                      </div>

                      <div class="col-md-6">

                        <b-form-group label-cols-sm="5" label="Tipo:" label-align-sm="right" :label-for="`tipo-disco-${d}`">
                          <b-form-radio-group
                          :id="`tipo-disco-${d}`"
                          v-model="disco.tipo"
                          :options="opcionesDisco"
                          buttons
                          button-variant="outline-primary"
                          name="radios-btn-default"
                          ></b-form-radio-group>
                        </b-form-group>

                        <!-- <b-form-group label-cols-sm="5" label="Tipo:" label-align-sm="right" :label-for="`tipo-disco-${d}`" >
                          <b-form-radio-group class="mt-2"
                          :id="`tipo-disco-${d}`"
                          v-model="disco.tipo"
                          :options="opcionesDisco"
                          name="radio-inline"
                          ></b-form-radio-group>
                        </b-form-group> -->
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <b-form-group label-cols-sm="2" label="Serial:" label-align-sm="right" :label-for="`serial-disco-${d}`" >
                          <b-form-input :id="`serial-disco-${d}`" v-model="disco.serial"></b-form-input>
                        </b-form-group>
                      </div>
                    </div>

                    <hr>

                  </div>
                  <div class="col-md-1">
                    <i class="mdi mdi-delete menos-ram" @click="menosDisco(d)"></i>
                  </div>

                </div>


              </b-form-group>
            </b-card>
          </div>

          <!-- Fuente poder -->
          <div v-show="active == 5">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="Fuente de Poder" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >

                <b-form-group label-cols-sm="3" label="Marca:" label-align-sm="right" label-for="marca-fuente" >
                  <b-form-input id="marca-fuente" v-model="form.fuente.marca"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Modelo:" label-align-sm="right" label-for="modelo-fuente" >
                  <b-form-input id="modelo-fuente" v-model="form.fuente.modelo"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Potencia(w):" label-align-sm="right" label-for="pot-fuente" >
                  <b-form-input id="pot-fuente" v-model="form.fuente.potencia"></b-form-input>
                </b-form-group>

                <div class="row justify-content-end">
                  <div class="col-md-5">
                    <b-form-group label-cols-sm="5" label="Factor Forma:" label-align-sm="right" label-for="ff-fuente" >
                      <b-form-input id="ff-fuente" v-model="form.fuente.factor_forma"></b-form-input>
                    </b-form-group>
                  </div>
                  <div class="col-md-6">
                    <b-form-group label-cols-sm="5" label="Alimentador:" label-align-sm="right" label-for="al-fuente" >
                      <b-form-input id="al-fuente" v-model="form.fuente.alimentador_energia"></b-form-input>
                    </b-form-group>
                  </div>
                </div>

              </b-form-group>
            </b-card>
          </div>

          <!-- perifericos -->
          <div v-show="active == 6">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="Perifericos" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >

                <b-form-group label-cols-sm="3" label="Lista Perifericos:" label-align-sm="right" label-for="perifericos" >

                  <el-select id="perifericos" v-model="form.perifericos" multiple collapse-tags style="margin-left: 20px;" placeholder="Seleccione Perifericos">
                  <el-option
                    v-for="(item,p) in dataPerifericos"
                    :key="p"
                    :label="item.nombre"
                    :value="item.id">
                  </el-option>
                  </el-select>
                </b-form-group>

              </b-form-group>
            </b-card>
          </div>

          <!-- asignar chasis y observaciones -->
          <div v-show="active == 7">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="Asignar Chasís" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >

                <b-form-group label-cols-sm="3" label="Chasís:" label-align-sm="right" label-for="nested-street" >
                  <el-select v-model="form.chasis" placeholder="Seleccione Chasís">
                    <el-option
                    v-for="(item,c) in dataChasis"
                    :key="c"
                    :label="item.placa"
                    :value="item.id">
                    <span style="float: left">{{ item.placa }}</span>
                    <span style="float: right; color: #8492a6; font-size: 13px">{{ item.marca }}</span>
                    </el-option>
                  </el-select>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Chasís:" label-align-sm="right" label-for="nested-street" >
                  <el-switch
                    class="mt-2"
                    style="display: block"
                    v-model="form.estado"
                    active-color="#13ce66"
                    inactive-color="#ff4949"
                    active-text="Activo"
                    inactive-text="Inactivo">
                  </el-switch>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Observación:" label-align-sm="right" label-for="observacion" >
                  <b-form-textarea id="observacion" v-model="form.observaciones" size="lg" placeholder="Escribe las observaciones aquí..." rows="3" no-resize ></b-form-textarea>
                </b-form-group>

              </b-form-group>
            </b-card>
          </div>

          <div class="row mt-3 mb-4">
            <div class="col-md-12 text-center">

              <button :disabled="active == 1" class="btn-ant" @click="prev">Ant.</button>
              <button v-if="active < 7" class="btn-sig" @click="next">Sig.</button>
              <button v-show="active == 7" class="btn-guardar" @click="guardarEquipo">Guardar</button>

            </div>
          </div>

        </div>
      </div>
    </div>

  </section>
</template>

<script>
export default {
  data(){
    return{
      ruta:'/api/pc/equipo',
      search: '',
      isLoading:false,
      active: 1,
      form:{
        estado:true,
        board:{},
        procesador:{},
        ram: [],
        disco:[],
        fuente:{},
        perifericos:[],
        chasis:null,
      },
      opcionesDisco: [
        { text: 'HDD', value: '1' },
        { text: 'SSD', value: '2' },
      ],
      dataPerifericos:[],
      dataChasis:[],
      formRam:{},
      formDisco:{},
    }
  },
  mounted(){
    this.isLoading = true
    Promise.all([
      this.listaPerifericos(),
      this.listarChasis(),
    ]).then(res => {
      this.isLoading = false
    })
  },
  // computed:{
  //
  // },

  methods: {
    async guardarEquipo(){
      try {
        this.form.estado = (this.form.estado === true)?1:0
        const {data} = await axios.post(`${this.ruta}/registrar-equipo`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','Imposible registrar equipo',data.error)
          return
        }
        this.form = {}
        this.$router.push({ name:'equipos.listar' })
        this.$Helper.notificacion('success','Equipo registrado',data.mensaje)

        // console.log(data,"la data de equipo");

      } catch (e) {
        console.warn(e,"No es posible registrar equipo");
      }
    },
    menosDisco(key=null){
      this.form.disco.splice(key,1)

      // _.forEach(this.formDisco, (val, key)=> {
      //   if ( key == dato ) {
      //     this.formDisco.splice( dato, 1 );
      //   }
      // });
    },
    agregarDisco(dato){
      this.form.disco.unshift({...this.formDisco})
      this.formDisco = {}
      // this.formDisco.push(dato)
      // this.formDisco++
    },
    menosRam(key=null){
      // _.forEach(this.formRam, (val, key)=> {
      //   if ( key == dato ) {
      //     this.formRam.splice( dato, 1 );
      //   }
      // });
      this.form.ram.splice(key,1)
    },
    agregarRam(){
      this.form.ram.unshift({...this.formRam})
      this.formRam = {}
      //this.formRam.push(dato)
      // this.formRam++
    },
    prev() {
      this.active--
    },
    next() {
      this.active++
    },
    async listarChasis(){
      try {
        const {data} = await axios(`/api/select/listar-chasis`)
        if (data.error) {
          this.$Helper.notificacion('warning','Problemas listar chasis',data.error)
          return
        }
        this.dataChasis = data
      } catch (e) {
        console.warn(e);
      }
    },
    async listaPerifericos(){
      try {
        const {data} = await axios(`/api/select/listar-perifericos`)
        if (data.error) {
          this.$Helper.notificacion('warning','Problemas listar perifercos',data.error)
          return
        }
        this.dataPerifericos = data
      } catch (e) {
        console.warn(e);
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.registrar-equipos{
  .menos-ram{
    border: 1px solid #710606;
    border-radius: 2px;
    padding: 1px;
    color: #710606;
    transition-duration: .85s;
    &:hover{
      color: white;
      background-color: #710606;
      transition-duration: .4s;
    }
  }
  .mas-ram{
    border: 3px solid midnightblue;
    border-radius: 50%;
    padding-left: 2px;
    padding-right: 2px;
    color: midnightblue;
    font-size: 17px;
    transition-duration: .85s;
    &:hover{
      color: white;
      background-color: midnightblue;
      transition-duration: .4s;
      cursor: pointer;
    }
  }
  .btn-guardar{
    border-radius: 1px 5px 5px 1px;
    border: 1px solid #034403;
    padding: 5px;
    color: #b9ffb9;
    background-color: #034403;
    margin-left: -3px;
  }
  .btn-sig{
    border-radius: 1px 5px 5px 1px;
    border: 1px solid midnightblue;
    padding: 5px;
    color: midnightblue;
    transition-duration: .85s;
    margin-left: -3px;
    &:hover{
      color: white;
      background-color: midnightblue;
      transition-duration: .4s;
    }
  }
  .btn-ant {
    margin-right: -3px;
    border-radius: 5px 1px 1px 5px;
    border: 1px solid midnightblue;
    padding: 5px;
    color: midnightblue;
    transition-duration: .85s;
    &:hover{
      color: white;
      background-color: midnightblue;
      transition-duration: .4s;
    }
  }
}
</style>
