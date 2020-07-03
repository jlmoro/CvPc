<template>
  <modal-b ref="modalProveedor">
    <div slot="header" class="row">
      <div class="col-12">
        <h5>Crear Usuario</h5>
      </div>
    </div>

    <div  slot="body" class="">
      <div class="row w-100 mb-5 mt-2">
        <div class="col-12 text-center">
          <croppa
          placeholder="Seleccione una imagen"
          :placeholder-font-size="14"
          :width="200"
          :height="191"
          :show-remove-button="true"
          :prevent-white-space="true"
          ref="CroppaProveedor"
          >
        </croppa>
      </div>
    </div>
    <div class="row w-100 mb-1">
      <div class="col-6">
        <label for="nombre-prov">Nombre(s):</label>
        <el-input type="text" placeholder="Nombre proveedor" v-model="form.name" maxlength="60" show-word-limit >
        </el-input>
      </div>
      <div class="col-6">
        <label for="nombre-prov">Apellido(s):</label>
        <el-input type="text" placeholder="Nombre proveedor" v-model="form.lastname" maxlength="60" show-word-limit >
        </el-input>
      </div>
    </div>
    <div class="row w-100 mt-1">
      <div class="col-6">
        <label for="telefono">Teléfono:</label>
        <el-input type="text" placeholder="Teléfono" v-model="form.telefono" maxlength="30" show-word-limit >
        </el-input>
      </div>
      <div class="col-6">
        <label for="direccion">Correo:</label>
        <el-input type="email" placeholder="Correo" v-model="form.direccion" maxlength="30" show-word-limit >
        </el-input>
      </div>
    </div>
  </div>

  <div slot="footer" class="">
    <button type="button" class="btn-crear" @click="crear_proveedor">Guardar</button>
    <button type="button" class="btn-cancelar" @click="toggle">Cancelar</button>
  </div>
</modal-b>
</template>

<script>
export default {
  props:[
    'ruta'
  ],
  data(){
    return{
      form:{
        logo:'',
      },
    }
  },
  methods:{
    async crear_proveedor(){
      try {
        this.form.logo = this.$refs.CroppaProveedor.img.src
        const {data} = await axios.post(`${this.ruta}/crear-proveedor`,this.form)
        this.form = {}
        this.$emit('proveedor:creado')
        this.$Helper.notificacion('success','Guardado',data.mensaje)
        this.$refs.CroppaProveedor.img.src = ""
        this.$refs.modalProveedor.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    toggle(){
      this.$refs.modalProveedor.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
.croppa-container{
  border-radius: 26px;
}
.img-proveedor{
  max-width: 98px;
  max-height: 332px;
  border-radius: 50%;
}
</style>
