<template>
  <section class="modal-crear-area">
    <modal ref="modalCrearArea">
      <div class="row" slot="header">
          <div class="col-12">
            <p class="f-20">Crear Rol - <span class="letra-capital">{{area.area}}</span></p>
          </div>
      </div>
      <div class="row justify-content-center" slot="body">
        <div class="col-md-12 text-center">
          <label for="crea_rol">Nombre Rol: </label>
          <input v-model="form.rol" type="text" id="crea_rol" class="input-general">
        </div>
      </div>
      <div class="row" slot="footer">
          <button type="button" class="btn-actualizar mr-2" @click="guardarRol">Guardar</button>
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
      form:{},
      area:""
    }
  },
  methods: {
    async guardarRol(){
      try {
        const {data} = await axios.post(`${this.ruta}/${this.area.id}/crear-rol`,this.form)
        if (data.error) {
            this.$Helper.notificacion('warning','Atención',data.error)
            return
        }
        this.$emit('rol:creado')
        this.form = ''
        this.$Helper.notificacion('success','Rol Guardado',data.mensaje)
        this.$refs.modalCrearArea.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    toggle(datos){
      this.area = _.cloneDeep(datos);
      this.$refs.modalCrearArea.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
.modal-crear-area{

}
</style>
