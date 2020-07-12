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
            <div class="col-md-6">
              <label for="">Tipo Evento:</label>
              <el-select v-model="form.tipo_evento" filterable placeholder="Seleccione Tipo Evento" clearable
              @change="listar_detalles_evento($event)">
                <el-option
                  v-for="(item,e) in tiposEventos"
                  :key="e"
                  :label="item.nombre"
                  :value="item.id">
                </el-option>
              </el-select>
            </div>
            <div class="col-md-6">
              <label for="">Descripción Evento:</label>
              <el-select v-model="form.descripcion_evento" filterable placeholder="Descripción Evento" clearable >
                <el-option
                  v-for="(item,e) in detalle_evento"
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
      <button type="button" class="btn-actualizar mr-2" @click="guardarSolucionPosible">Guardar</button>
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
      form:{
        tipo_evento:null,
      },
      detalle_evento:[]
    }
  },
  methods: {
    async guardarSolucionPosible(){
      try {
        const {data} = await axios.post(`${this.ruta}/registrar-solucion-posible`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','Atención',data.error)
          return
        }
        this.$emit('solucion:creada')
        this.form = ''
        this.$Helper.notificacion('success','Posible Solución Registrada',data.mensaje)
        this.$refs.modalRegistrarSolucion.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    async listar_detalles_evento(event){
      try {
        const {data} = await axios(`/api/select/${event}/listar-descripcion-eventos`)
        if (data.error) {
          this.$Helper.notificacion('warning','No es posible listar detalle eventos',data.error)
          return
        }
        this.detalle_evento = data;

      } catch (e) {
        console.warn(e);
      }
    },
    toggle(){
      this.$refs.modalRegistrarSolucion.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
.modal-registrar-solucion{

}
</style>
