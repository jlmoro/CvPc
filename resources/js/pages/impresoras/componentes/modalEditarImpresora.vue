<template>
  <section class="editar-impresora">
    <modal ref="ModalEditarImpresora">
      <div slot="header" class="row">
        <div class="col-12">
          <h5>Editar Impresora</h5>
        </div>
      </div>
      <div slot="body" class="row w-100">
        <div class="col-12">
          <div class="row w-100">
            <div class="col-md-6">
              <label for="marca2" class="letra-capital">marca</label>
              <input v-model="impresora.marca" id="marca2" type="text" class="input-general">
            </div>
            <div class="col-md-6">
              <label for="placa2" class="letra-capital">placa</label>
              <input v-model="impresora.placa" id="placa2" type="text" class="input-general">
            </div>
          </div>
          <div class="row w-100 mt-3">
            <div class="col-md-7">
              <label for="serial2" class="letra-capital">serial</label>
              <input v-model="impresora.serial" id="serial2" type="text" class="input-general" style="width: inherit !important;">
            </div>
            <div class="col-md-5 mt-4 pt-2">
              <el-switch
              style="display: block"
              v-model="impresora.estado"
              active-color="#13ce66"
              inactive-color="#ff4949"
              active-text="Act."
              inactive-text="Inact.">
              </el-switch>
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
              <label for="observaciones" class="letra-capital">observaciones</label>
              <textarea v-model="impresora.observaciones" id="observaciones" name="name" rows="5" cols="80" class="txt-area"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div slot="footer" class="row">
        <div class="col-12">
          <button type="button" class="btn-crear" @click="guardarImpresora">Actualizar</button>
          <button type="button" class="btn-cancelar" @click="toggle">Cancelar</button>
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
    'proveedores',
  ],
  components:{
    Modal:()=> import('~/components/modales/modalB')
  },
  data(){
    return{
      impresora:{
        encargado:null,
        proveedor:null,
        estado:true,
      }
    }
  },
  methods:{
    async guardarImpresora(){
      try {
        this.form.estado = (this.form.estado === true)?1:0
        const {data} = await axios.put(`${this.ruta}/editar-impresora`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al editar impresora',data.error)
          return
        }
        this.$Helper.notificacion('success','Impresora Actualizada',data.mensaje)
        this.$emit('impresora:editada')
        this.$refs.ModalEditarImpresora.toggle()

      } catch (e) {
        console.warn(e);
      }
    },
    agregaEncargado(data){
      console.log(data);
      this.impresora.encargado = data
    },
    agregaProveedor(data){
      this.impresora.proveedor = data
    },
    toggle(dato){
      this.impresora = _.cloneDeep(dato);
      this.impresora.estado = (this.impresora.estado === 1)?true:false
      this.impresora.encargado = _.find(this.encargados, function(o) { return o.id_encargado });
      this.$refs.ModalEditarImpresora.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
