<template>
  <section class="modal-editar-evento">
    <modal ref="modalEditarTipoEvento">
      <div class="row" slot="header">
          <div class="col-12">
            <p class="f-20">Editar Periferico</p>
          </div>
      </div>

        <div class="row justify-content-center" slot="body">
          <div class="col-md-12 text-center">
            <label for="crearTipo" class="letra-capital">tipo evento: </label>
            <input v-model="eventoTipo.nombre_tipo" type="text" id="area" class="input-general">
          </div>
        </div>

      <div class="row" slot="footer">
          <button type="button" class="btn-actualizar mr-2" @click="editarArea">Actualizar</button>
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
      eventoTipo:{}
    }
  },
  methods: {
    async editarArea(){
      try {
        const {data} = await axios.put(`${this.ruta}/editar-evento-tipo`,this.eventoTipo)
        if (data.error) {
            this.$Helper.notificacion('warning','Atención',data.error)
            return
        }
        this.$emit('eventoTipo:actualizado')
        this.eventoTipo = ''
        this.$Helper.notificacion('success','Tipo Evento Actualizado',data.mensaje)
        this.$refs.modalEditarTipoEvento.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    toggle(dato){
      this.eventoTipo = _.cloneDeep(dato);
      this.$refs.modalEditarTipoEvento.toggle()
    }
  }
}
</script>
<style lang="scss" scoped>

</style>
