<template>
  <section class="modal-crear-area">
    <modal-b ref="modalCrearEventoTipo">
      <div class="row" slot="header">
        <div class="col-12">
          <p class="f-20">Descripcion Tipo Evento</p>
        </div>
      </div>
      <div class="row justify-content-center" slot="body">
        <div class="col-md-12 text-center">
          <label for="crearTipoE" class="letra-capital">Descripción: </label>
          <input type="text" v-model="form.nombre_tipo" name="" value="">
          <!-- <input type="text" v-model="form.nombre_tipo" id="crearTipoE" class="input-general"/> -->
        </div>
      </div>
      <div class="row" slot="footer">
        <button type="button" class="btn-actualizar mr-2" @click="guardarDescripcion">Guardar</button>
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
      form:{},
      tipoEvento:{}
    }
  },
  methods: {
    async guardarDescripcion(){
      try {
        const {data} = await axios.post(`${this.ruta}/crear-evento-descripcion`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','Atención',data.error)
          return
        }
        this.$emit('eventoTipo:creado')
        this.form = ''
        this.$Helper.notificacion('success','Descripcion Evento Guardado',data.mensaje)
        this.$refs.modalCrearEventoTipo.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    toggle(dato){
      this.tipoEvento = _.cloneDeep(dato)
      console.log(this.tipoEvento);
      this.$refs.modalCrearEventoTipo.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
.modal-crear-area{

}
</style>
