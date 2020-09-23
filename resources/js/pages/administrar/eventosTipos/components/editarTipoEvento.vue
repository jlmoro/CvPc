<template>
  <section class="modal-editar-evento">
    <modal-b ref="modalEditarTipoEvento">
      <div class="row" slot="header">
        <div class="col-12">
          <p class="f-20">Editar Tipo Evento</p>
        </div>
      </div>
      <div class="row justify-content-center" slot="body">
        <div class="col-md-8 text-center">
          <label for="editarTipoE" class="letra-capital">Tipo evento: </label>
          <b-form-input v-model="form.nombre_tipo"></b-form-input>
          <!-- <input type="text" v-model="form.nombre_tipo" id="crearTipoE" class="input-general"/> -->
        </div>
        <div class="col-md-4 text-center">
          <label for="editarSiglaE" class="letra-capital">Sigla: </label>
          <b-form-input id="editarSiglaE" v-model="form.sigla"></b-form-input>
          <!-- <input type="text"  v-model="form.sigla"> -->
        </div>
      </div>
      <div class="row" slot="footer">
        <button type="button" class="btn-actualizar mr-2" @click="editarTipoEvento">Actualizar</button>
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
    Modal:()=> import('~/components/modales/modalB'),
  },
  data(){
    return{
      form:{}
    }
  },
  methods: {
    async editarTipoEvento(){
      try {
        const {data} = await axios.put(`${this.ruta}/editar-evento-tipo`,this.form)
        if (data.error) {
            this.$Helper.notificacion('warning','Atención',data.error)
            return
        }
        this.$emit('eventoTipo:actualizado')
        this.form = ''
        this.$Helper.notificacion('success','Tipo Evento Actualizado',data.mensaje)
        this.$refs.modalEditarTipoEvento.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    toggle(dato){
      this.form = _.cloneDeep(dato);
      this.$refs.modalEditarTipoEvento.toggle()
    }
  }
}
</script>
<style lang="scss" scoped>

</style>
