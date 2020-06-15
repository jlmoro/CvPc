<template>
  <section class="crear-pc">
    <modal ref="ModalRegistrarPc">
      <div slot="header" class="row">
        <div class="col-12">
          <h5>Fuente de Poder</h5>
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
              <label for="placaP" class="letra-capital">potencia</label>
              <input v-model="form.potencia" id="placaP" type="number" placeholder="Watts/Vatios" class="input-general">
            </div>
          </div>
          <div class="row w-100 mt-3">
            <div class="col-md-6">
              <label for="serialFP" class="letra-capital">serial</label>
              <input v-model="form.serial" id="serialFP" type="text" class="input-general" style="width: inherit !important;">
            </div>
            <div class="col-md-6">
              <label for="serialP" class="letra-capital">alimentador energía</label>
              <input v-model="form.alimentador_energia" id="serialP" type="number" placeholder="cantidad pines" class="input-general" style="width: inherit !important;">
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
          <button type="button" class="btn-crear" @click="guardarFuente">Guardar</button>
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
    async guardarFuente(){
      try {
        const {data} = await axios.post(`${this.ruta}/registrar-fuente`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','Error registrando chasis',data.error)
          return
        }
        this.$emit('fuente:registrada')
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
