<template>
  <section class="modal-registrar-solucion">
    <modal ref="modalRegistrarSolucion">
      <div class="row" slot="header">
        <div class="col-12">
          <p class="f-20 letra-capital">registrar posible solución</p>
        </div>
      </div>
      <div class="row" slot="body">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
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
        <div class="row mt-4">
          <div class="col-md-12">
            <label for="">Solución Posible</label>
            <textarea v-model="form.solucion_posible" class="txt-area" rows="5" cols="80"></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="row" slot="footer">
      <button type="button" class="btn-actualizar mr-2" @click="actualizarSolucionPosible">Actualizar</button>
      <button type="button" class="btn-cancelar" data-dismiss="modal">Cancelar</button>
    </div>
  </modal>
</section>
</template>

<script>
export default {
  props: [
    'ruta',
    'tiposEventos'
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
    async actualizarSolucionPosible(){
      try {
        const {data} = await axios.put(`${this.ruta}/actualizar-solucion-posible`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','Atención',data.error)
          return
        }
        this.$emit('solucion:actualizada')
        this.form = ''
        this.$Helper.notificacion('success','Posible Solución Actualizada',data.mensaje)
        this.$refs.modalRegistrarSolucion.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    toggle(dato){
      this.form = _.cloneDeep(dato);
      let id_tipo_evento = _.find(this.tiposEventos, function(o) { return o.id === dato.id_evento_tipo; });
      this.form.tipo_evento = id_tipo_evento.id
      this.$refs.modalRegistrarSolucion.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
.modal-registrar-solucion{

}
</style>
