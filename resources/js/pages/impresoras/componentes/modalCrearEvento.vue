<template>
  <section class="modal-crear-evento">
    <modal-b ref="modalCrearEvento">
      <div slot="header" class="row">
        <div class="col-12">
          <h5>Registrar Evento Impresora</h5>
        </div>
      </div>
      <div slot="body" class="">

        <div class="row w-100 mb-3">
        <div class="col-md-6">
          <label for="">Tipo Evento:</label>
          <el-select v-model="form.id_tipo_evento" filterable placeholder="Seleccione Tipo Evento" clearable >
            <el-option
            v-for="(item,e) in tiposEventos"
            :key="e"
            :label="item.nombre"
            :value="item.id">
          </el-option>
        </el-select>
      </div>
    </div>
    <div class="row w-100">
      <div class="col-md-12">
        <label for="">Descripción:</label>
        <textarea v-model="form.descripcion" name="name" rows="5" cols="80" class="txt-area"></textarea>
      </div>
    </div>
  </div>
  <div slot="footer" class="">
    <button type="button" class="btn-crear" @click="registrarEvento">Registrar</button>
    <button type="button" class="btn-cancelar" data-dismiss="modal">Cancelar</button>
  </div>
</modal-b>
</section>
</template>

<script>
export default {
  props: [
    'ruta',
    'tiposEventos'
  ],
  data(){
    return{
      form:{
        id_tipo_evento:null,
      },
      impresora:{}
    }
  },
  methods:{
    async registrarEvento(){
      try {
        const {data} = await axios.post(`${this.ruta}/eventos/${this.impresora.id}/registrar-evento-impresora`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al registrar',data.error)
          return
        }
        this.$emit('evento:registrado')
        this.$Helper.notificacion('success','Evento Registrado',data.mensaje)
        this.$refs.modalCrearEvento.toggle()

      } catch (e) {
        console.warn(e);
      }
    },

    toggle(dato){
      this.impresora = _.cloneDeep(dato)
      this.$refs.modalCrearEvento.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
