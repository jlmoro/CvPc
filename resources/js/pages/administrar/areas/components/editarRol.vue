editarRol<template>
  <section class="modal-editar-area">
    <modal ref="modalEditarRol">
      <div class="row" slot="header">
          <div class="col-12">
            <p class="f-20">Editar Rol</p>
          </div>
      </div>

        <div class="row justify-content-center" slot="body">
          <div class="col-md-12 text-center">
            <label for="edita_rol">Nombre Rol: </label>
            <input v-model="rol.nombre_rol" type="text" id="edita_rol" class="input-general">
          </div>
        </div>

      <div class="row" slot="footer">
          <button type="button" class="btn-actualizar mr-2" @click="editarRol">Actualizar</button>
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
      rol:{}
    }
  },
  methods: {
    async editarRol(){
      try {
        const {data} = await axios.put(`${this.ruta}/editar-rol`,this.rol)
        if (data.error) {
            this.$Helper.notificacion('warning','Atención',data.error)
            return
        }
        this.$emit('rol:editado')
        this.rol = ''
        this.$Helper.notificacion('success','Rol Actualizado',data.mensaje)
        this.$refs.modalEditarRol.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    toggle(dato){
      this.rol = _.cloneDeep(dato);
      this.$refs.modalEditarRol.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
