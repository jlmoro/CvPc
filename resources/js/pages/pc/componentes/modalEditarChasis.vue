<template>
  <section class="editar-pc">
    <modal ref="ModalEditarPc">
      <div slot="header" class="row">
        <div class="col-12">
          <h5>Editar Chasis</h5>
        </div>
      </div>
      <div slot="body" class="row w-100">
        <div class="col-12">
          <div class="row w-100">
            <div class="col-md-6">
              <label for="marcaChasis" class="letra-capital">marca</label>
              <input v-model="form.marca" id="marcaChasis" type="text" class="input-general">
            </div>
            <div class="col-md-6">
              <label for="placaChasis" class="letra-capital">placa</label>
              <input v-model="form.placa" id="placaChasis" type="text" class="input-general">
            </div>
          </div>
          <div class="row w-100 mt-3">
            <div class="col-md-7">
              <label for="serialChasis" class="letra-capital">serial</label>
              <input v-model="form.serial" id="serialChasis" type="text" class="input-general" style="width: inherit !important;">
            </div>
            <div class="col-md-5 mt-4 pt-2">
              <el-switch
              style="display: block"
              v-model="form.estado"
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
              <label for="observacionesChasis" class="letra-capital">observaciones</label>
              <textarea v-model="form.observaciones" id="observacionesChasis" name="name" rows="5" cols="80" class="txt-area"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div slot="footer" class="row">
        <div class="col-12">
          <button type="button" class="btn-crear" @click="guardarPc">Guardar</button>
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
    async guardarPc(){
      try {
        this.form.estado = (this.form.estado === true)?1:0
        const {data} = await axios.put(`${this.ruta}/editar-pc`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','Error registrando chasis',data.error)
          return
        }
        this.form = ''
        this.$emit('pc:editado')
        this.$Helper.notificacion('success','Chasis Actualizado',data.mensaje)
        this.$refs.ModalEditarPc.toggle()

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
    toggle(dato){
      this.form = _.cloneDeep(dato)
      this.form.estado = (dato.estado === 1)?true:false
      console.log(this.form);
      this.$refs.ModalEditarPc.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
