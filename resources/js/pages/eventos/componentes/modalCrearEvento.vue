<template>
  <section class="modal-crear-evento">
    <modal-b ref="modalCrearEvento">
      <div slot="header" class="row">
        <div class="col-12">
          <h5>Registrar Evento</h5>
        </div>
      </div>
      <div slot="body" class="">
        <div class="row w-100 mb-3">
          <div class="col-md-12 text-center">
            <!-- <label for="" class="letra-capital">Tipo Dispositivo: </label> -->
            <el-radio-group v-model="form.tipo_dispositivo" size="medium">
              <el-radio-button label="1">PC</el-radio-button>
              <el-radio-button label="2" >Pantalla</el-radio-button>
              <el-radio-button label="3" >Impresora</el-radio-button>
            </el-radio-group>
          </div>
        </div>
        <div class="row w-100 mb-3">
          <div class="col-md-6">
            <label for="">Dispositivo:</label>
            <input type="text" class="input-general">
          </div>
          <div class="col-md-6">
            <label for="">Tipo Evento:</label>
            <el-select v-model="form.tipo_evento" filterable placeholder="Seleccione Tipo Evento" clearable >
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
            <textarea name="name" rows="5" cols="80" class="txt-area"></textarea>
          </div>
        </div>
      </div>
      <div slot="footer" class="">
        <button type="button" class="btn-crear" >Registrar</button>
        <button type="button" class="btn-cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </modal-b>
  </section>
</template>

<script>
export default {
  data(){
    return{
      form:{
        tipo_dispositivo:'',
        tipo_evento:null,
      },
      tiposEventos:[],
    }
  },
  mounted() {
    this.eventosTipos()

  },
  methods:{
    async eventosTipos(){
      try {
        const {data} = await axios(`/api/select/listar-tipos-eventos`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar',data.error)
          return
        }
        this.tiposEventos = data

      } catch (e) {
        console.warn(e);
      }
    },
    toggle(){
      this.$refs.modalCrearEvento.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
