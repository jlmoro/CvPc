<template>
  <modal-b ref="modalProveedor">
    <div slot="header" class="row">
      <div class="col-12">
        <h5>Crear Usuario</h5>
      </div>
    </div>

    <div  slot="body" class="">
      <div class="row w-100 mb-3 mt-2">
        <div class="col-12 text-center">
          <croppa
          v-model="form.foto"
          placeholder="Seleccione una imagen"
          :placeholder-font-size="12"
          :width="140"
          :height="146"
          :show-remove-button="true"
          :prevent-white-space="true"
          >
          <!-- ref="CroppaProveedor" -->
        </croppa>
      </div>
    </div>
    <div class="row w-100 mb-1">
      <div class="col-6">
        <label for="nombre-prov">Nombre(s):</label>
        <el-input type="text" placeholder="Nombre(s)" v-model="form.name" maxlength="60" show-word-limit >
        </el-input>
      </div>
      <div class="col-6">
        <label for="nombre-prov">Apellido(s):</label>
        <el-input type="text" placeholder="Apellido(s)" v-model="form.lastname" maxlength="60" show-word-limit >
        </el-input>
      </div>
    </div>
    <div class="row w-100 mt-1">
      <div class="col-6">
        <label for="tipo_doc">Tipo Documento:</label>
        <el-input type="text" placeholder="Tipo Documento" v-model="form.tipo_doc" maxlength="30" show-word-limit >
        </el-input>
      </div>
      <div class="col-6">
        <label for="documento">Documento:</label>
        <el-input type="number" placeholder="Documento" v-model="form.documento" maxlength="12" show-word-limit >
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
    <div class="row w-100 mt-1">
      <div class="col-6">
        <label for="area">Area:</label>
        <el-select v-model="form.id_area" filterable clearable placeholder="Seleccione Área" @change="listar_roles($event)">
          <el-option
            v-for="(item,a) in areas"
            :key="a"
            :label="item.nombre"
            :value="item.id">
          </el-option>
        </el-select>
      </div>
      <div class="col-6">
        <label for="rol">Rol:</label>
        <el-select v-model="form.id_rol" filterable clearable placeholder="Seleccione Rol">
          <el-option
            v-for="(item,r) in roles"
            :key="a"
            :label="item.nombre"
            :value="item.id">
          </el-option>
        </el-select>
      </div>
    </div>
    <div class="row w-100 mt-1">
      <div class="col-6">
        <label for="password">Contraseña:</label>
        <el-input type="password" placeholder="Pass" v-model="form.password" maxlength="30" show-word-limit >
        </el-input>
      </div>
      <div class="col-6">
        <label for="cc">Confirmar Contraseña:</label>
        <el-input type="password" placeholder="C Pass" v-model="form.cc" maxlength="30" show-word-limit >
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
    'ruta',
    'areas'
  ],
  data(){
    return{
      form:{
        foto:null,
        roles:[],
        id_area:null,
      },
    }
  },
  methods:{
    async crear_proveedor(){
      try {
        // this.form.logo = this.$refs.CroppaProveedor.img.src
        const {data} = await axios.post(`${this.ruta}/crear-usuario`,this.form)
        this.form = {}
        this.$emit('proveedor:creado')
        this.$Helper.notificacion('success','Guardado',data.mensaje)
        this.$refs.modalProveedor.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    async listar_roles(area){
      this.form.id_rol = ''
      console.log(area);
      try {

        const {data} = await axios(`/api/select/${area}/listar-roles`)
        if (data.error) {
          this.$Helper.notificacion('warning','Problemas al listar roles',data.error)
          return
        }
        this.roles = data

      } catch (e) {
        return console.warn(e);
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
