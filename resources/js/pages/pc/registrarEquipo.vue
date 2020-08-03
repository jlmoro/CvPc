<template>
  <section class="registrar-equipos" v-loading="isLoading">
    <div class="mb-4 text-center">
      <h5 class="mt-4">Registrar Equipo</h5>
    </div>

    <div class="container">
      <div class="row w-100">
        <div class="col-md-12">

          <el-steps :active="active" finish-status="success">
            <el-step title="Step 1"></el-step>
            <el-step title="Step 2"></el-step>
            <el-step title="Step 3"> </el-step>
            <el-step title="Step 4"> </el-step>
            <el-step title="Step 5"> </el-step>
            <el-step title="Step 6"> </el-step>
          </el-steps>

          <div v-show="active == 1">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="Placa Base" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >

                <b-form-group label-cols-sm="3" label="Street:" label-align-sm="right" label-for="nested-street" >
                  <b-form-input id="nested-street"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="City:" label-align-sm="right" label-for="nested-city" >
                  <b-form-input id="nested-city"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="State:" label-align-sm="right" label-for="nested-state" >
                  <b-form-input id="nested-state"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Country:" label-align-sm="right" label-for="nested-country" >
                  <b-form-input id="nested-country"></b-form-input>
                </b-form-group>

              </b-form-group>
            </b-card>
          </div>

          <div v-show="active == 2">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="Procesador" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >

                <b-form-group label-cols-sm="3" label="Street:" label-align-sm="right" label-for="nested-street" >
                  <b-form-input id="nested-street"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="City:" label-align-sm="right" label-for="nested-city" >
                  <b-form-input id="nested-city"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="State:" label-align-sm="right" label-for="nested-state" >
                  <b-form-input id="nested-state"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Country:" label-align-sm="right" label-for="nested-country" >
                  <b-form-input id="nested-country"></b-form-input>
                </b-form-group>

              </b-form-group>
            </b-card>
          </div>

          <div v-show="active == 3">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="Memoria RAM" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >

                <b-form-group label-cols-sm="3" label="Street:" label-align-sm="right" label-for="nested-street" >
                  <b-form-input id="nested-street"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="City:" label-align-sm="right" label-for="nested-city" >
                  <b-form-input id="nested-city"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="State:" label-align-sm="right" label-for="nested-state" >
                  <b-form-input id="nested-state"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Country:" label-align-sm="right" label-for="nested-country" >
                  <b-form-input id="nested-country"></b-form-input>
                </b-form-group>

              </b-form-group>
            </b-card>
          </div>

          <div v-show="active == 4">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="HDD/SSD" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >

                <b-form-group label-cols-sm="3" label="Street:" label-align-sm="right" label-for="nested-street" >
                  <b-form-input id="nested-street"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="City:" label-align-sm="right" label-for="nested-city" >
                  <b-form-input id="nested-city"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="State:" label-align-sm="right" label-for="nested-state" >
                  <b-form-input id="nested-state"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Country:" label-align-sm="right" label-for="nested-country" >
                  <b-form-input id="nested-country"></b-form-input>
                </b-form-group>

              </b-form-group>
            </b-card>
          </div>

          <div v-show="active == 5">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="Fuente de Poder" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >

                <b-form-group label-cols-sm="3" label="Street:" label-align-sm="right" label-for="nested-street" >
                  <b-form-input id="nested-street"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="City:" label-align-sm="right" label-for="nested-city" >
                  <b-form-input id="nested-city"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="State:" label-align-sm="right" label-for="nested-state" >
                  <b-form-input id="nested-state"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Country:" label-align-sm="right" label-for="nested-country" >
                  <b-form-input id="nested-country"></b-form-input>
                </b-form-group>

              </b-form-group>
            </b-card>
          </div>

          <div v-show="active == 6">
            <b-card bg-variant="light">
              <b-form-group label-cols-lg="3" label="Perifericos" label-size="lg" label-class="font-weight-bold pt-0" class="mb-0" >

                <b-form-group label-cols-sm="3" label="Street:" label-align-sm="right" label-for="nested-street" >
                  <b-form-input id="nested-street"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="City:" label-align-sm="right" label-for="nested-city" >
                  <b-form-input id="nested-city"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="State:" label-align-sm="right" label-for="nested-state" >
                  <b-form-input id="nested-state"></b-form-input>
                </b-form-group>

                <b-form-group label-cols-sm="3" label="Country:" label-align-sm="right" label-for="nested-country" >
                  <b-form-input id="nested-country"></b-form-input>
                </b-form-group>

              </b-form-group>
            </b-card>
          </div>

          <el-button :disabled="active == 1" style="margin-top: 12px;" @click="prev">Ant.</el-button>
          <el-button v-if="active < 6" style="margin-top: 12px;" @click="next">Sig.</el-button>
          <el-button v-show="active == 6" style="margin-top: 12px;" @click="next">Guardar</el-button>

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
    }
  },
  mounted(){
    this.isLoading = true
    Promise.all([
      // this.listar_procesador(),
    ]).then(res => {
      this.isLoading = false
    })
  },
  // computed:{
  //
  // },

  methods: {
    prev() {
      this.active--
    },
    next() {
      this.active++
    }
  }
}
</script>

<style lang="scss" scoped>
.registrar-equipos{

}
</style>
