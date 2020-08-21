<template>
  <section class="modal-crear-evento">
    <modal-b ref="modalCrearEvento">
      <div slot="header" class="row">
        <div class="col-12">
          <h5>Resolver Evento</h5>
        </div>
      </div>
      <div slot="body" class="">
        <div class="row w-100 mb-3">
          <div class="col-md-6">
            <label for="">Fecha:</label>
            <flat-pickr v-model="form.fecha_resolver"
            class="input-general"
            :config="fechaNac"
            />
          </div>
          <div class="col-md-6">
            <label for="">Persona Asignada:</label>
            <el-select v-model="form.id_usuario_resolver" filterable placeholder="Seleccione Usuario">
              <el-option
              v-for="(item,u) in usuarios"
              :key="u"
              :label="item.name"
              :value="item.id">
              <span style="float: left">{{ item.name}}</span>
              <span style="float: right; color: #8492a6; font-size: 13px">{{ item.lastname }}</span>
              </el-option>
            </el-select>
          </div>
        </div>
    </div>
  </div>
  <div slot="footer" class="">
    <button type="button" class="btn-crear" @click="asignarFecha">Registrar</button>
    <button type="button" class="btn-cancelar" data-dismiss="modal">Cancelar</button>
  </div>
</modal-b>
</section>
</template>

<script>
export default {
  props: [
    'ruta',
    'tiposEventos',
    'usuarios'
  ],
  data(){
    return{
      form:{},
      fechaNac:{
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        minDate: 'today',
      },
      infoEvento:{},
      solucionPosible:{},
    }
  },
  methods:{
    async asignarFecha(){
      try {
        const {data} = await axios.post(`${this.ruta}/${this.infoEvento.id}/fecha-solucion-evento-torre`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al registrar',data.error)
          return
        }
        this.$emit('evento:asignado')
        this.$Helper.notificacion('success','Evento Asignado',data.mensaje)
        this.$refs.modalCrearEvento.toggle()

      } catch (e) {
        console.warn(e);
      }
    },
    async toggle(dato){
      this.infoEvento = _.cloneDeep(dato)
      this.$refs.modalCrearEvento.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
