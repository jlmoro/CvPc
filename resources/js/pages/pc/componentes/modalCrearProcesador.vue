<template>
  <section class="crear-pc">
    <modal ref="ModalRegistrarPc">
      <div slot="header" class="row">
        <div class="col-12">
          <h5>Registrar Procesador</h5>
        </div>
      </div>
      <div slot="body" class="row w-100">
        <div class="col-12">
          <div class="row w-100">
            <div class="col-md-6">
              <label for="marcaPr" class="letra-capital">marca</label>
              <input v-model="form.marca" id="marcaPr" type="text" class="input-general">
            </div>
            <div class="col-md-6">
              <label for="modeloPr" class="letra-capital">modelo</label>
              <input v-model="form.modelo_tecnologia" id="modeloPr" type="text" class="input-general">
            </div>
          </div>
          <div class="row w-100 mt-3">
            <div class="col-md-6">
              <label for="frecuenciaPr" class="letra-capital">frecuencia</label>
              <input v-model="form.serial" id="frecuenciaPr" type="text" placeholder="GHz" class="input-general" style="width: inherit !important;">
            </div>
            <div class="col-md-6">
              <label for="generacionPr" class="letra-capital">generación</label>
              <input v-model="form.generacion" id="generacionPr" type="number" class="input-general" style="width: inherit !important;">
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
          <button type="button" class="btn-crear" @click="guardarProcesador">Guardar</button>
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
      form:{}
    }
  },
  methods:{
    async guardarProcesador(){
      try {
        const {data} = await axios.post(`${this.ruta}/registrar-procesador`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','Error registrando procesador',data.error)
          return
        }
        this.$emit('procesador:registrado')
        this.$Helper.notificacion('success','Fuente Registrada',data.mensaje)
        this.$refs.ModalRegistrarPc.toggle()

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
      this.$refs.ModalRegistrarPc.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
