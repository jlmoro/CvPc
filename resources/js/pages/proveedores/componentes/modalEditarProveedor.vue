<template>
  <modal-b ref="modalProveedor">
    <div slot="header" class="row">
      <div class="col-12">
        <h5>Editar Proveedor</h5>
      </div>
    </div>

    <div  slot="body" class="">
      <div class="row w-100 mb-5 mt-2">
        <div class="col-12 text-center">
          <croppa
          :initial-image="form.logo"
          slot="initial"
          placeholder="Seleccione una imagen"
          crossOrigin="anonymous"
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
      <div class="col-12">
        <label for="nombre-prov">Nombre Proveedor</label>
        <el-input type="text" placeholder="Nombre proveedor" v-model="form.nombre_proveedor" maxlength="60" show-word-limit >
        </el-input>
      </div>
    </div>
    <div class="row w-100 mt-1">
      <div class="col-6">
        <label for="telefono">Teléfono</label>
        <el-input type="text" placeholder="Teléfono" v-model="form.telefono" maxlength="30" show-word-limit >
        </el-input>
      </div>
      <div class="col-6">
        <label for="direccion">Dirección</label>
        <el-input type="text" placeholder="Please input" v-model="form.direccion" maxlength="30" show-word-limit >
        </el-input>
      </div>
    </div>
  </div>

  <div slot="footer" class="">
    <button type="button" class="btn-actualizar" @click="actualizar_proveedor">Actualizar</button>
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
    async actualizar_proveedor(){
      try {

        this.form.logo = this.$refs.CroppaProveedor.img.src
        const {data} = await axios.post(`${this.ruta}/crear-proveedor`,this.form)
        this.form = {}
        this.$emit('proveedor:creado')
        this.$Helper.notificacion('success','Guardado',data.mensaje)
        this.$refs.modalProveedor.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    toggle(dato){
      // console.log(dato,"editando proveedorrrrrrrrrrr");
      this.form = _.cloneDeep(dato);
      this.form.logo = `/storage/${this.form.logo}`
      console.log(this.form.logo,"logooooooooo");
      let image = this.$refs.CroppaProveedor.initialImage
      image = `storage/${this.form.logo}`
      // if (this.form.logo !== null) {
      // }else {
      //   image = `img/user_default.jpg`
      // }
      this.$refs.modalProveedor.toggle()
      // console.log(`${this.$refs.CroppaProveedor.initialImage}/storage/${this.form.logo}`);
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
