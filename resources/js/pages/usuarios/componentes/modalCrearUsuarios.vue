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
          <!-- <croppa
          v-model="form.foto"
          placeholder="Seleccione una imagen"
          :placeholder-font-size="12"
          :width="140"
          :height="146"
          :show-remove-button="true"
          :prevent-white-space="true"
          > -->
          <!-- ref="CroppaProveedor" -->
        <!-- </croppa> -->
        <el-upload
          class="avatar-uploader"
          action="https://jsonplaceholder.typicode.com/posts/"
          :show-file-list="false"
          :on-success="handleAvatarSuccess"
          :before-upload="beforeAvatarUpload">
          <img v-if="imageUrl" :src="imageUrl" class="avatar">
          <i v-else class="el-icon-plus avatar-uploader-icon"></i>
        </el-upload>
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
        <el-input type="email" id="correo-usu" placeholder="Correo" v-model="form.correo" maxlength="30" show-word-limit >
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
    handleAvatarSuccess(res, file) {
      this.imageUrl = URL.createObjectURL(file.raw);
    },
    beforeAvatarUpload(file) {
      const isJPG = file.type === 'image/jpeg';
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (!isJPG) {
        this.$message.error('La imagen debe estar en formato JPG!');
      }
      if (!isLt2M) {
        this.$message.error('La imagen excede los 2MB!');
      }
      return isJPG && isLt2M;
    },
    async crear_usuario(){

      try {
        var fd = new FormData()
        this.form.foto.generateBlob((blob) => {
          fd.append('foto', blob)
          fd.append('name', this.form.name)
          fd.append('tipo_doc', this.form.tipo_doc)
          fd.append('documento', this.form.documento)
          fd.append('telefono', this.form.telefono)
          fd.append('email', this.form.correo)
          fd.append('id_rol', this.form.id_rol)
          fd.append('password', this.form.password)

        })
        = await axios.post(`${this.ruta}/crear-usuario`,fd)

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
.croppa-container{
  border-radius: 26px;
}
.img-proveedor{
  max-width: 98px;
  max-height: 332px;
  border-radius: 50%;
}
</style>
