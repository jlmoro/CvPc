<template>
  <section class="crear-impresora">
    <modal ref="ModalCrearImpresora">
      <div slot="header" class="row">
        <div class="col-12">
          <h5>Registrar Impresora</h5>
        </div>
      </div>
      <div slot="body" class="row w-100">
        <div class="col-12">
          <div class="row w-100">
            <div class="col-md-6">
              <label for="" class="letra-capital">marca</label>
              <input v-model="form.marca" type="text" class="input-general">
            </div>
            <div class="col-md-6">
              <label for="" class="letra-capital">placa</label>
              <input v-model="form.placa" type="text" class="input-general">
            </div>
          </div>
          <div class="row w-100 mt-3">
            <div class="col-12">
              <label for="" class="letra-capital">serial</label>
              <input v-model="form.serial" type="text" class="input-general" style="width: inherit !important;">
            </div>
          </div>
          <div class="row w-100 mt-3">
            <div class="col-md-6">
              <label for="" class="letra-capital">encargado</label>
              <select-encargados @encargados="agregaEncargado"/>
            </div>
            <div class="col-md-6">
              <label for="" class="letra-capital">proveedor</label>
              <select-proveedores @proveedor="agregaProveedor"/>
            </div>
          </div>
          <div class="row w-100 mt-3">
            <div class="col-md-12">
              <label for="" class="letra-capital">observaciones</label>
              <textarea v-model="form.observaciones" name="name" rows="5" cols="80" class="txt-area"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div slot="footer" class="row">
        <div class="col-12">
          <button type="button" class="btn-crear" @click="guardarImpresora">Guardar</button>
          <button type="button" class="btn-cancelar" @click="toggle">Cancelar</button>
        </div>
      </div>
    </modal>
  </section>
</template>

<script>
export default {
  props: [
    'ruta'
  ],
  components:{
    Modal:()=> import('~/components/modales/modalB')
  },
  data(){
    return{
      form:{
        encargado:null,
        proveedor:null,
      }
    }
  },
  methods:{
    async guardarImpresora(){
      try {
        const {data} = await axios.post(`${this.ruta}/crear-impresora`,this.form)
        if (data.error) {
          this.$Helper.notificacion(warning,'Error creando impresora',data.error)
          return
        }

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
      this.$refs.ModalCrearImpresora.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
