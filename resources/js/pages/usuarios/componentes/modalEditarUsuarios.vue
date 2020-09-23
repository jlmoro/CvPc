<template>
  <modal-b ref="modalUsuario" >
    <div slot="header" class="row">
      <div class="col-12">
        <h5>Editar Usuario</h5>
      </div>
    </div>

    <div  slot="body" class="">
      <div class="row w-100 mb-3 mt-2">
        <div class="col-12 text-center">

        <croppa
          placeholder="Seleccione una imagen"
          :placeholder-font-size="14"
          :width="171"
          :height="173"
          :show-remove-button="true"
          :prevent-white-space="true"
          ref="CroppaUsuarios"
          initial-size="natural"
          initial-position="100% 20%"
        />
        <!-- <img crossOrigin="anonymous" class="imagen-principal" :src="`/storage/${form.foto}`" slot="initial" -->

      </div>
    </div>
    <div class="row w-100 mb-1">
      <div class="col-6">
        <label for="editN-usu">Nombre(s):</label>
        <el-input type="text" id="editN-usu" placeholder="Nombre(s)" v-model="form.name" maxlength="60" show-word-limit >
        </el-input>
      </div>
      <div class="col-6">
        <label for="editA-usu">Apellido(s):</label>
        <el-input type="text" id="editA-usu" placeholder="Apellido(s)" v-model="form.lastname" maxlength="60" show-word-limit >
        </el-input>
      </div>
    </div>
    <div class="row w-100 mt-1">
      <div class="col-6">
        <label >Tipo Documento:</label>
        <el-select v-model="form.tipo_doc" filterable clearable placeholder="Tipo Documento">
          <el-option
            v-for="(item,d) in tipoDoc"
            :key="d"
            :label="item.label"
            :value="item.id">
          </el-option>
        </el-select>
      </div>
      <div class="col-6">
        <label for="editD-usu">Documento:</label>
        <el-input type="number" id="editD-usu" placeholder="Documento" v-model="form.documento" maxlength="12" show-word-limit >
        </el-input>
      </div>
    </div>
    <div class="row w-100 mt-1">
      <div class="col-6">
        <label for="editT-usu">Teléfono:</label>
        <el-input type="number" id="editT-usu" placeholder="Teléfono" v-model="form.telefono" maxlength="30" show-word-limit >
        </el-input>
      </div>
      <div class="col-6">
        <label for="editCO-usu">Correo:</label>
        <el-input type="email" id="editCO-usu" placeholder="Correo" v-model="form.email" maxlength="30" show-word-limit >
        </el-input>
      </div>
    </div>
    <div class="row w-100 mt-1">
      <div class="col-6">
        <label >Area:</label>
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
        <label>Rol:</label>
        <el-select v-model="form.id_rol" filterable clearable placeholder="Seleccione Rol">
          <el-option
            v-for="(rol,r) in roles"
            :key="r"
            :label="rol.rol"
            :value="rol.id">
          </el-option>
        </el-select>
      </div>
    </div>
    <div class="row w-100 mt-1">
      <div class="col-6">
        <label for="editP-usu">Contraseña:</label>
        <el-input type="password" id="editP-usu" placeholder="*********" v-model="form.password" maxlength="30" show-word-limit >
        </el-input>
      </div>
      <div class="col-6">
        <label for="cc">Confirmar Contraseña:</label>
        <el-input type="password" placeholder="*********" v-model="form.cpassword" maxlength="30" show-word-limit >
        </el-input>
      </div>
    </div>
  </div>

  <div slot="footer" class="">
    <button type="button" class="btn-crear" @click="crear_usuario">Guardar</button>
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

      dialogImageUrl: '',
      dialogVisible: false,
      disabled: false,

      form:{
        foto:null,
        id_rol:null,
        // id_area:null,
        // tipo_doc:null,
      },
      tipoDoc: [{
          id: 1,
          label: 'C.C.'
        }, {
          id: 2,
          label: 'C.E.'
        },
      ],
      imageUrl: '',
      imagen:{},
      roles:[],
    }
  },

  methods:{
    async crear_usuario(){

      try {
        this.form.foto = this.$refs.CroppaUsuarios.img.src
        const {data} = await axios.put(`${this.ruta}/editar-usuario`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','No se pudo actualizar el usuario',data.error)
          return
        }
        this.$emit('usuario:editado')
        this.$Helper.notificacion('success','Usuario Actualizado',data.mensaje)
        this.$refs.modalUsuario.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    async listar_roles(area){
      this.form.id_rol = ''
      try {
        const {data} = await axios(`/api/select/${area}/listar-roles`)
        if (data.error) {
          this.$Helper.notificacion('warning','Problemas al listar roles',data.error)
          return
        }
        // console.log(data,"lista de roles");
        this.roles = data
      } catch (e) {
        return console.warn(e);
      }
    },
    toggle(dato){
      this.form = _.cloneDeep(dato)
      // if (this.form.foto == null) {
      //   this.form.foto = `/img/user_default.jpg`
      // }else {
      //   this.form.foto = this.form.foto
      // }
      this.$refs.modalUsuario.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
.imagen-principal{
  width: 173px;
  height: 171px;
}
.avatar-uploader-icon {
  font-size: 28px;
  color: #8c939d;
  width: 165px;
  height: 165px;
  line-height: 165px;
  text-align: center;
}
.croppa-container{
  border-radius: 26px;
}
.img-proveedor{
  max-width: 98px;
  max-height: 332px;
  border-radius: 50%;
}
</style>
