<template>
  <section class="registrar-impresora">
    <modal ref="ModalRegistrarPantalla">
      <div slot="header" class="row">
        <div class="col-12">
          <h5>Registrar Pantalla</h5>
        </div>
      </div>
      <div slot="body" class="row w-100">
        <div class="col-12">
          <div class="row w-100">
            <div class="col-md-6">
              <label for="marcaP" class="letra-capital">marca</label>
              <input v-model="form.marca" id="marcaP" type="text" class="input-general">
            </div>
            <div class="col-md-6">
              <label for="modeloP" class="letra-capital">modelo</label>
              <input id="modeloP" v-model="form.modelo" type="text" class="input-general" style="width: inherit !important;">
            </div>
          </div>
          <div class="row w-100 mt-3">
            <div class="col-md-6">
              <label for="placaP" class="letra-capital">placa</label>
              <input v-model="form.placa" id="placaP" type="text" class="input-general">
              <!-- <input v-model="form.modelo" id="modelo" type="text" class="input-general" style="width: inherit !important;"> -->

            </div>
            <div class="col-md-6 mt-4 pt-2">
              <el-switch
              style="display: block"
              v-model="form.estado"
              active-color="#13ce66"
              inactive-color="#ff4949"
              active-text="Activo"
              inactive-text="Inactivo">
              </el-switch>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12">
              <label for="serialP" class="letra-capital">serial</label>
              <input v-model="form.serial" id="serialP" type="text" class="input-general" style="width: inherit !important;">
            </div>
          </div>
          <div class="row w-100 mt-3">
            <div class="col-md-6">
              <label for="" class="letra-capital">encargado</label>
              <select-encargados @encargados="agregaEncargado" :encargados="encargados"/>
            </div>
            <div class="col-md-6">
              <label for="" class="letra-capital">proveedor</label>
              <select-proveedores @proveedor="agregaProveedor" :proveedores="proveedores"/>
            </div>
          </div>
          <div class="row w-100 mt-3">
            <div class="col-md-12">
              <label for="observacionesP" class="letra-capital">observaciones</label>
              <textarea v-model="form.observaciones" id="observacionesP" name="name" rows="5" cols="80" class="txt-area"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div slot="footer" class="row">
        <div class="col-12">
          <button type="button" class="btn-crear" @click="guardarPantalla">
            <span class="mdi mdi-check"></span>
            Guardar
          </button>
          <button type="button" class="btn-cancelar" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </modal>
  </section>
</template>

<script>
export default {
  props: [
    'ruta',
    'encargados',
    'proveedores'
  ],
  components:{
    Modal:()=> import('~/components/modales/modalB')
  },
  data(){
    return{
      form:{
        encargado:null,
        proveedor:null,
        estado:true,
      }
    }
  },
  methods:{
    async guardarPantalla(){
      try {
        this.form.estado = (this.form.estado === true)?1:0
        const {data} = await axios.post(`${this.ruta}/registrar-pantalla`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','Error creando impresora',data.error)
          return
        }
        this.$Helper.notificacion('success','Impresora Registrada',data.mensaje)
        this.$emit('impresora:creada')
        this.$refs.ModalRegistrarPantalla.toggle()

      } catch (e) {
        console.warn(e);
      }
    },
    agregaEncargado(data){
      this.form.encargado = data
    },
    agregaProveedor(data){
      this.form.proveedor = data
    },
    toggle(){
      this.$refs.ModalRegistrarPantalla.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
