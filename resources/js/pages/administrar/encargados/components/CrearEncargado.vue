<template>
  <section class="crear-encargado">
    <modal  ref="modalEncargado">
      <div class="row" slot="header">
        <div class="col-md-12">
          <p class="f-20">Nuevo encargado</p>
        </div>
      </div>
      <div class="" slot="body">
        <div class="row w-100 mb-5 mt-2">
          <div class="col-12 text-center">
            <croppa
            placeholder="Seleccione una imagen"
            :placeholder-font-size="14"
            :width="169"
            :height="158"
            :quality="1"
            :show-remove-button="true"
            :prevent-white-space="true"
            initial-position="100% 20%"
            ref="CroppaEncargado"
            >
            <!-- ref="CroppaEncargado" -->
          </croppa>
        </div>
      </div>
      <div class="row w-100">
        <div class="col-12">
          <label for="nombreE">Nombre Completo</label>
          <el-input id="nombreE" type="text" placeholder="Nombre Completo" v-model="form.nombre_completo" maxlength="70" show-word-limit />
        </div>
      </div>
      <div class="row w-100">
        <div class="col-6">
          <label for="tipo_documento">Tipo Documento</label>
          <el-select v-model="form.tipo_doc" placeholder="Seleccionar Tipo Doc">
            <el-option
            v-for="item in tipo_documento"
            :key="item.value"
            :label="item.label"
            :value="item.value">
          </el-option>
        </el-select>
      </div>
      <div class="col-6">
        <label for="documentoE">Documento</label>
        <el-input id="documentoE" type="text" placeholder="Documento" v-model="form.documento" maxlength="30" show-word-limit >
        </el-input>
      </div>
    </div>
    <div class="row w-100 mt-3">
      <div class="col-6">
        <label for="fecha_de_nacimiento">Fecha de Nacimiento</label>
        <flat-pickr v-model="form.fecha_nacimiento"
        class="input-general"
        :config="fechaNac"
        />

      </div>
      <div class="col-6">
        <label for="telefonoE">Teléfono</label>
        <el-input id="telefonoE" type="text" placeholder="Teléfono" v-model="form.telefono" >
        </el-input>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <label for="area">Área</label>
        <!-- <select-areas /> -->
        <el-select v-model="form.area" filterable placeholder="Seleccione área" @change="listar_roles">
          <el-option
          v-for="(item,a) in areas"
          :key="a"
          :label="item.nombre"
          :value="item.id">
        </el-option>
      </el-select>
    </div>
    <div class="col-6">
      <label for="fecha_de_nacimiento">Rol</label>
      <!-- <select-roles/> -->
      <el-select v-model="form.rol" filterable placeholder="Seleccione rol">
        <el-option
        v-for="(item,a) in roles"
        :key="a"
        :label="item.rol"
        :value="item.id">
      </el-option>
    </el-select>
  </div>
</div>
</div>
<div class="" slot="footer">
  <button type="button" class="btn-actualizar" @click="crear_encargado">Guardar</button>
  <button type="button" class="btn-cancelar" data-dismiss="modal">Cancelar</button>
</div>
</modal>
</section>
</template>

<script>
export default {
  props:[
    'areas',
    'ruta',
  ],
  components:{
    Modal:()=> import('~/components/modales/modalB'),
  },
  data(){
    return{
      form:{
        foto:'',
        area:'',
        rol:'',
      },
      roles:[],
      fechaNac:{
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        maxDate: 'today'
      },
      tipo_documento: [{
        value: '1',
        label: 'C.C.'
      }, {
        value: '2',
        label: 'C.E.'
      }],
      value: ''
    }
  },
  methods:{
    async crear_encargado(){
      try {
        this.form.foto = this.$refs.CroppaEncargado.img.src
        // const {data} = await axios.post(`${this.ruta}/crear-encargado`)
        const {data} = await axios.post(`${this.ruta}/crear-encargado`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','Atención',data.error)
          return
        }
        this.$emit('encargado:creado')
        this.form = ''
        this.$Helper.notificacion('success','Encargado Guardado',data.mensaje)
        this.$refs.modalEncargado.toggle()
      } catch (e) {
        console.warn(e)
      }
    },
    async listar_roles(id_area){
      this.form.rol = ''
      try {
        const {data} = await axios(`/api/select/${id_area}/listar-roles`)
        if (data.error) {
          this.$Helper.notificacion('warning','Atención',data.error)
          return
        }
        this.roles = data;

      } catch (e){
        console.warn(e);
      }
    },
    toggle(){
      this.$refs.modalEncargado.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
.croppa-container{
  border-radius: 26px;
}
</style>
