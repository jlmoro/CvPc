<template>
  <section class="modal-editar-evento">
    <modal-b ref="modalEditarEvento">
      <div slot="header" class="row">
        <div class="col-12">
          <h5>Editar Evento</h5>
        </div>
      </div>
      <div slot="body" class="">
        <div class="row w-100 mb-3">
          <div class="col-md-12 text-center">
            <!-- <label for="" class="letra-capital">Tipo Dispositivo: </label> -->
            <el-radio-group v-model="form.tipo_dispositivo" size="medium" @change="listaPlacas($event)">
              <el-radio-button label="1">PC</el-radio-button>
              <el-radio-button label="2" >Pantalla</el-radio-button>
              <el-radio-button label="3" >Impresora</el-radio-button>
            </el-radio-group>
          </div>
        </div>
        <div class="row w-100 mb-3">
          <div class="col-md-6">
            <label for="">Dispositivo:</label>
            <el-select v-model="form.dipositivo" filterable placeholder="Seleccione Placa" clearable >
              <el-option
              v-for="(item,d) in dispositivos"
              :key="d"
              :label="item.placa"
              :value="item.id">
            </el-option>
          </el-select>
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
        <textarea v-model="form.descripcion" name="name" rows="5" cols="80" class="txt-area"></textarea>
      </div>
    </div>
  </div>
  <div slot="footer" class="">
    <button type="button" class="btn-crear" @click="registrarEvento">Actualizar</button>
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
        tipo_dispositivo:'',
        tipo_evento:null,
      },
      dispositivos:[],

    }
  },

  methods:{
    async registrarEvento(){
      try {
        const {data} = await axios.put(`${this.ruta}/editar-evento`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al actualizar',data.error)
          return
        }
        this.$emit('evento:registrado')
        this.$Helper.notificacion('success','Evento Actualizado',data.mensaje)
        this.$refs.modalEditarEvento.toggle()

      } catch (e) {
        console.warn(e);
      }
    },
    listaPlacas(e){
      switch (e) {
        case '1':
        this.litarPc()
        break;
        case '2':
        this.listarPantalla()
        break;
        case '3':
        this.listarImpresora()
        break;
        default:
        console.log('ninguno');
        break;
      }
    },
    async litarPc(){
      try {
        const {data} = await axios(`/api/select/listar-pc`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar ',data.error)
          return
        }
        this.dispositivos = data
      } catch (e) {
        console.warn(e);
      }
    },
    async listarPantalla(){
      try {
        const {data} = await axios(`/api/select/listar-pantallas`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar ',data.error)
          return
        }
        this.dispositivos = data
      } catch (e) {
        console.warn(e);
      }
    },
    async listarImpresora(){
      try {
        const {data} = await axios(`/api/select/listar-impresoras`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar ',data.error)
          return
        }
        this.dispositivos = data
      } catch (e) {
        console.warn(e);
      }
    },

    toggle(dato){
    this.form = _.cloneDeep(dato);
      this.$refs.modalEditarEvento.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
