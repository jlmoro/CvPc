<template>
  <section class="modal-crear-area">
    <modal ref="modalCrearArea">
      <div class="row" slot="header">
          <div class="col-12">
            <p class="f-20">Registrar Periferico</p>
          </div>
      </div>
      <div class="row justify-content-center" slot="body">
        <div class="col-md-12 text-center">
          <label for="crearPerif" class="letra-capital">periferico: </label>
          <input v-model="form.nombre_tipo" type="text" id="crearPerif" class="input-general">
        </div>
      </div>
      <div class="row" slot="footer">
          <button type="button" class="btn-actualizar mr-2" @click="guardarperiferico">Guardar</button>
          <button type="button" class="btn-cancelar" data-dismiss="modal">Cancelar</button>
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
    Modal:()=> import('~/components/modales/modalB'),
  },
  data(){
    return{
      form:{}
    }
  },
  methods: {
    async guardarperiferico(){
      try {
        const {data} = await axios.post(`${this.ruta}/crear-evento-tipo`,this.form)
        if (data.error) {
            this.$Helper.notificacion('warning','Atención',data.error)
            return
        }
        this.$emit('eventoTipo:creado')
        this.form = ''
        this.$Helper.notificacion('success','Tipo Evento Guardado',data.mensaje)
        this.$refs.modalCrearArea.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    toggle(){
      this.$refs.modalCrearArea.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
.modal-crear-area{

}
</style>
