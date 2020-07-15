<template>
  <modal-b ref="modalUsuario" >
    <div slot="header" class="row">
      <div class="col-12">
        <h5>Crear Usuario</h5>
      </div>
    </div>

    <div  slot="body" class="">
      <div class="row w-100 mb-3 mt-2">
        <div class="col-12 text-center">
          <!-- v-model="form.foto" -->
          <croppa
          placeholder="Seleccione una imagen"
          :accept="'image/png'"
          :placeholder-font-size="12"
          :width="140"
          :height="146"
          :show-remove-button="true"
          :prevent-white-space="true"
          ref="CroppaUsuarios"
          >
        </croppa>

      </div>
    </div>
    <div class="row w-100 mb-1">
      <div class="col-6">
        <label for="nombre-usu">Nombre(s):</label>
        <el-input type="text" id="nombre-usu" placeholder="Nombre(s)" v-model="form.name" maxlength="60" show-word-limit >
        </el-input>
      </div>
      <div class="col-6">
        <label for="apellido-usu">Apellido(s):</label>
        <el-input type="text" id="apellido-usu" placeholder="Apellido(s)" v-model="form.lastname" maxlength="60" show-word-limit >
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
        <label for="doc-usu">Documento:</label>
        <el-input type="number" id="doc-usu" placeholder="Documento" v-model="form.documento" maxlength="12" show-word-limit >
        </el-input>
      </div>
    </div>
    <div class="row w-100 mt-1">
      <div class="col-6">
        <label for="tel-usu">Teléfono:</label>
        <el-input type="number" id="tel-usu" placeholder="Teléfono" v-model="form.telefono" maxlength="30" show-word-limit >
        </el-input>
      </div>
      <div class="col-6">
        <label for="correo-usu">Correo:</label>
        <el-input type="email" id="correo-usu" placeholder="Correo" v-model="form.email" maxlength="30" show-word-limit >
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
            v-for="(item,r) in roles"
            :key="r"
            :label="item.rol"
            :value="item.id">
          </el-option>
        </el-select>
      </div>
    </div>
    <div class="row w-100 mt-1">
      <div class="col-6">
        <label for="pass">Contraseña:</label>
        <el-input type="password" id="pass" placeholder="Contraseña" v-model="form.password" maxlength="30" show-word-limit >
        </el-input>
      </div>
      <div class="col-6">
        <label for="cc">Confirmar Contraseña:</label>
        <el-input type="password" placeholder="Confirmar Contraseña" v-model="form.cpassword" maxlength="30" show-word-limit >
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
        const {data} = await axios.post(`${this.ruta}/crear-usuario`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','No se pudo crear el usuario',data.error)
          return
        }
        this.$emit('usuario:creado')
        this.$Helper.notificacion('success','Usuario Creado',data.mensaje)
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
        this.roles = data
      } catch (e) {
        return console.warn(e);
      }
    },
    toggle(){
      this.$refs.modalUsuario.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

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
