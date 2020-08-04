<template>
  <section class="registrar-equipos" v-loading="isLoading">
    <div class="mb-4 text-center">
      <h5 class="mt-4">Registrar Equipo</h5>
    </div>

    <div class="container">
      <div class="row w-100">
        <div class="col-md-12">

          <div class="mb-3">
            <el-steps :active="active" finish-status="success">
              <el-step title="Step 1"></el-step>
              <el-step title="Step 2"></el-step>
              <el-step title="Step 3"> </el-step>
              <el-step title="Step 4"> </el-step>
              <el-step title="Step 5"> </el-step>
              <el-step title="Step 6"> </el-step>
              <el-step title="Step 7"> </el-step>
            </el-steps>
          </div>

          <div v-show="active == 1">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="Placa Base" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >

                <b-form-group label-cols-sm="3" label="Marca:" label-align-sm="right" label-for="marca-board" >
                  <b-form-input id="marca-board" v-model="form.board_marca"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Modelo:" label-align-sm="right" label-for="modelo-board" >
                  <b-form-input id="modelo-board" v-model="form.board_modelo"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="PCI:" label-align-sm="right" label-for="pci-board" >
                  <b-form-input id="pci-board" type="number" v-model="form.board_pci"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="PCI-X:" label-align-sm="right" label-for="pcix-board" >
                  <b-form-input id="pcix-board" type="number" v-model="form.board_pcix"></b-form-input>
                </b-form-group>

              </b-form-group>
            </b-card>
          </div>

          <div v-show="active == 2">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="Procesador" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >

                <b-form-group label-cols-sm="3" label="Marca:" label-align-sm="right" label-for="marca-proc" >
                  <b-form-input id="marca-proc"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Modelo:" label-align-sm="right" label-for="modelo-proc" >
                  <b-form-input id="modelo-proc"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Núcleos:" label-align-sm="right" label-for="nuc-proc" >
                  <b-form-input id="nuc-proc"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Velocidad:" label-align-sm="right" label-for="vel-proc" >
                  <b-form-input id="vel-proc"></b-form-input>
                </b-form-group>

              </b-form-group>
            </b-card>
          </div>

          <div v-show="active == 3">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="Memoria RAM" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >
                <div class="row" v-for="(ram,r) in formRam.length" :key="r">
                  <div class="col-md-11">

                    <div class="row">
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="4" label="Marca:" label-align-sm="right" :label-for="`marca-ram-${r}`" >
                          <b-form-input :id="`marca-ram-${r}`"></b-form-input>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="5" label="Tecnología:" label-align-sm="right" :label-for="`tec-ram-${r}`" >
                          <b-form-input :id="`tec-ram-${r}`"></b-form-input>
                        </b-form-group>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="4" label="Modelo:" label-align-sm="right" :label-for="`modelo-ram-${r}`" >
                          <b-form-input :id="`modelo-ram-${r}`"></b-form-input>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="5" label="Velocidad:" label-align-sm="right" :label-for="`velocidad-ram-${r}`" >
                          <b-form-input :id="`velocidad-ram-${r}`" type="number"></b-form-input>
                        </b-form-group>
                      </div>
                    </div>

                    <hr>

                  </div>
                  <div class="col-md-1">
                    <i v-show="formRam.length > 1" class="mdi mdi-delete menos-ram" @click="menosRam(r)"></i>
                  </div>

                </div>

                <div class="row mb-2">
                  <div class="col-sm-12 text-right">
                    <i class="mdi mdi-plus mas-ram" @click="agregarRam(formRam.length + 1)"></i>
                  </div>
                </div>

              </b-form-group>
            </b-card>
          </div>

          <div v-show="active == 4">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="HDD/SSD" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >
                <div class="row" v-for="(disco,d) in formDisco.length" :key="d">
                  <div class="col-md-11">

                    <div class="row">
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="4" label="Marca:" label-align-sm="right" :label-for="`marca-disco-${d}`" >
                          <b-form-input :id="`marca-disco-${d}`"></b-form-input>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="5" label="Capacidad:" label-align-sm="right" :label-for="`cap-disco-${d}`" >
                          <b-form-input :id="`cap-disco-${d}`"></b-form-input>
                        </b-form-group>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="4" label="Modelo:" label-align-sm="right" :label-for="`modelo-disco-${d}`" >
                          <b-form-input :id="`modelo-disco-${d}`"></b-form-input>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="5" label="Tecnología:" label-align-sm="right" :label-for="`tecno-disco-${d}`" >
                          <b-form-input :id="`tecno-disco-${d}`" type="number"></b-form-input>
                        </b-form-group>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="4" label="RPM:" label-align-sm="right" :label-for="`rpm-disco-${d}`" >
                          <b-form-input :id="`rpm-disco-${d}`"></b-form-input>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-group label-cols-sm="5" label="Tipo:" label-align-sm="right" :label-for="`tipo-disco-${d}`" >
                          <b-form-radio-group class="mt-2"
                          v-model="form.disco.tipo[d]"
                          :options="form.opcionesDisco"
                          name="radio-inline"
                          ></b-form-radio-group>
                        </b-form-group>
                      </div>
                    </div>

                    <hr>

                  </div>
                  <div class="col-md-1">
                    <i v-show="formDisco.length > 1" class="mdi mdi-delete menos-ram" @click="menosDisco(d)"></i>
                  </div>

                </div>

                <div class="row mb-2">
                  <div class="col-sm-12 text-right">
                    <i class="mdi mdi-plus mas-ram" @click="agregarDisco(formDisco.length + 1)"></i>
                  </div>
                </div>
              </b-form-group>
            </b-card>
          </div>

          <div v-show="active == 5">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="Fuente de Poder" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >

                <b-form-group label-cols-sm="3" label="Marca:" label-align-sm="right" label-for="marca-fuente" >
                  <b-form-input id="marca-fuente"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Modelo:" label-align-sm="right" label-for="modelo-fuente" >
                  <b-form-input id="modelo-fuente"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Potencia(w):" label-align-sm="right" label-for="pot-fuente" >
                  <b-form-input id="pot-fuente"></b-form-input>
                </b-form-group>

                <div class="row">
                  <div class="col-md-6">
                    <b-form-group label-cols-sm="3" label="Factor Forma:" label-align-sm="right" label-for="ff-fuente" >
                      <b-form-input id="ff-fuente"></b-form-input>
                    </b-form-group>
                  </div>
                  <div class="col-md-6">
                    <b-form-group label-cols-sm="3" label="Alimentador:" label-align-sm="right" label-for="al-fuente" >
                      <b-form-input id="al-fuente"></b-form-input>
                    </b-form-group>
                  </div>
                </div>

              </b-form-group>
            </b-card>
          </div>

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

                <b-form-group label-cols-sm="3" label="Observación:" label-align-sm="right" label-for="observacion" >
                  <b-form-textarea id="observacion" size="lg" placeholder="Escribe las observaciones aquí..." rows="3" no-resize ></b-form-textarea>
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
      ruta:'/api/pc/procesador',
      search: '',
      isLoading:false,
      active: 1,
      form:{
        chasis:null,
        perifericos:[],
        disco:{
          tipo:[]
        },
        opcionesDisco: [
          { text: 'HDD', value: '1' },
          { text: 'SSD', value: '2' },
        ],
      },
      dataPerifericos:[],
      dataChasis:[],
      formRam:[1],
      formDisco:[1],
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
    menosDisco(dato){
      _.forEach(this.formDisco, (val, key)=> {
        if ( key == dato ) {
          this.formDisco.splice( dato, 1 );
        }
      });
    },
    agregarDisco(dato){
      this.formDisco.push(dato)
      // this.formDisco++
    },
    menosRam(dato){
      _.forEach(this.formRam, (val, key)=> {
        if ( key == dato ) {
          this.formRam.splice( dato, 1 );
        }
      });
    },
    agregarRam(dato){
      this.formRam.push(dato)
      // this.formRam++
    },
    guardarEquipo(){
      console.log("Guarda aquiiii");
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
