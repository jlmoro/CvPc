<template>
  <section class="modal-crear-area">
    <modal ref="modalCrearArea">
      <div class="row" slot="header">
          <div class="col-12">
            <p class="f-20">Crear Área</p>
          </div>
      </div>
      <div class="row justify-content-center" slot="body">
        <div class="col-md-12 text-center">
          <label for="area">Nombre Área: </label>
          <input v-model="form.nombre" type="text" id="area" class="input-general">
        </div>
      </div>
      <div class="row" slot="footer">
          <button type="button" class="btn-actualizar mr-2" @click="guardarArea">Guardar</button>
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
    async guardarArea(){
      try {
        const {data} = await axios.post(`${this.ruta}/crear-area`,this.form)
        if (data.error) {
            this.$Helper.notificacion('warning','Atención',data.error)
            return
        }
        this.$emit('area:creada')
        this.form = ''
        this.$Helper.notificacion('success','Área Guardada',data.mensaje)
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
