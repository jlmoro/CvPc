<template>
  <section class="modal-editar-area">
    <modal ref="modalEditarArea">
      <div class="row" slot="header">
          <div class="col-12">
            <p class="f-20">Editar Área</p>
          </div>
      </div>

        <div class="row justify-content-center" slot="body">
          <div class="col-md-12 text-center">
            <label for="area">Nombre Área: </label>
            <input v-model="area.area" type="text" id="area" class="input-general">
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
      area:{}
    }
  },
  methods: {
    async editarArea(){
      let model = { id:this.area.id, nombre:this.area.area };
      try {
        const {data} = await axios.put(`${this.ruta}/editar-area`,model)
        if (data.error) {
            this.$Helper.notificacion('warning','Atención',data.error)
            return
        }
        this.$emit('area:actualizada')
        this.area = ''
        this.$Helper.notificacion('success','Área Guardada',data.mensaje)
        this.$refs.modalEditarArea.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    toggle(dato){
      this.area = _.cloneDeep(dato);
      this.$refs.modalEditarArea.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
