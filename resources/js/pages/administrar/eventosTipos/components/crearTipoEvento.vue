<template>
  <section class="modal-crear-area">
    <modal-b ref="modalCrearEventoTipo">
      <div class="row" slot="header">
        <div class="col-12">
          <p class="f-20">Nuevo Tipo Evento</p>
        </div>
      </div>
      <div class="row justify-content-center" slot="body">
        <div class="col-md-8 text-center">
          <label for="crearTipoE" class="letra-capital">Tipo evento: </label>
          <b-form-input v-model="form.nombre_tipo"></b-form-input>
          <!-- <input type="text" v-model="form.nombre_tipo" id="crearTipoE" class="input-general"/> -->
        </div>
        <div class="col-md-4 text-center">
          <label for="sigla" class="letra-capital">Sigla: </label>
          <b-form-input id="sigla" v-model="form.sigla"></b-form-input>
          <!-- <input type="text"  v-model="form.sigla"> -->
        </div>
      </div>
      <div class="row" slot="footer">
        <button type="button" class="btn-actualizar mr-2" @click="guardarArea">Guardar</button>
        <button type="button" class="btn-cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </modal-b>
  </section>
</template>

<script>
export default {
  props: [
    'ruta'
  ],
  components:{
    // Modal:()=> import('~/components/modales/modalB'),
  },
  data(){
    return{
      form:{
        // nombre_tipo:''
      }
    }
  },
  methods: {
    async guardarArea(){
      try {
        const {data} = await axios.post(`${this.ruta}/crear-evento-tipo`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','Atención',data.error)
          return
        }
        this.$emit('eventoTipo:creado')
        this.form = ''
        this.$Helper.notificacion('success','Tipo Evento Guardado',data.mensaje)
        this.$refs.modalCrearEventoTipo.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    toggle(){
      this.$refs.modalCrearEventoTipo.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
.modal-crear-area{

}
</style>
