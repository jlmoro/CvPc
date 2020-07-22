<template>
  <section class="listar-usuarios mb-5">

    <encabezado-datos tituloEncabezado="Usuarios" tituloBoton="Crear Usuario" @accionBonton="abrirCrearUsuario"/>

    <div class="row" v-loading="isLoading">
      <div v-for="(data,e) in usuarios" :key="e" class="col-md-4">
        <div class="card-padre">
          <div class="row">
            <div class="col-md-12 card-encabezado">
              <div class="row">
                <div class="col-md-2 ml-1 pr-0">
                  <el-switch
                    style="display: block"
                    v-model="data.estado_usuario"
                    active-color="#13ce66"
                    inactive-color="#ff4949"
                    @change="estadoUser(data)"
                    :disabled="data.id == user.id"
                    >
                  </el-switch>
                </div>
                <div class="col-md-7 pl-0 pr-0">
                  <span class="letra-capital f-16">{{data.documento}}</span>
                </div>
                <div class="col-md pl-0 pr-0">
                  <div class="card-acciones">
                    <span class="mdi mdi-pencil editar-user" @click="editarUsuarios(data)"></span>
                    <span v-show="data.id !== user.id" class="mdi mdi-delete eliminar-user" @click="modalEliminar(data)"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr style="border-top-color: #0000003b;">
          <div :class="data.estado == 0?'usuario-inactivo':''">
            <div class="row">
              <div class="col-md-12">
                <img v-if="data.foto != null"  class="img-user" :src="`/storage/${data.foto}`"/>
                <img v-else class="img-user" src="img/user_default.jpg"/>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <span class="letra-capital f-14">{{data.name}} {{data.lastname}} - {{data.telefono}}</span><br>
                <span class="f-12">{{data.email}}</span>
              </div>
            </div>
            <hr style="width: 194px; border-top-color: #00000038;">
            <div class="row">
              <div class="col-md-12 card-pie">
                <span class="mdi mdi-magnify ver-mas"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <modal-crear ref="modalCrearProveedor" :ruta="ruta" @usuario:creado="listar_usuarios" :areas="areas"/>
    <modal-editar ref="modalEditarProveedor" :ruta="ruta" :areas="areas"/>

    <modal-eliminar ref="ModalEliminar"
    titulo="eliminar proveedor"
    :cuerpo="`¿Desea eliminar el proveedor ${eliminarProv.nombre_proveedor}?`"
    @eliminar="eliminandoUsuarios"
    />
  </section>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  components: {
    ModalCrear:()=> import('./componentes/modalCrearUsuarios'),
    ModalEditar:()=> import('./componentes/modalEditarUsuarios')
  },
  data(){
    return{
      ruta:'/api/usuarios',
      usuarios:[],
      areas:[],
      eliminarProv:'',
      isLoading:false,
      estado:null,
    }
  },
  computed:{
    ...mapGetters({
      user: 'auth/user',
    }),
  },
  mounted(){
    this.isLoading = true
    Promise.all([
      this.listar_usuarios(),
      this.listar_areas(),
    ]).then(res=>{
      this.isLoading = false
    })
  },
  methods:{
    async estadoUser(dato){
      try {
        const {data} = await axios.put(`${this.ruta}/${dato.id}/estado-usuario`)
        if (data.error) {
          this.$Helper.notificacion('warning','Imposible cambiar estado',data.error)
          return
        }
        if (data.mensaje2) {
          this.$Helper.notificacion('warning','No es posible inactivar',data.mensaje2)
          this.listar_usuarios()
          return
        }
        this.listar_usuarios()
        this.$Helper.notificacion('success','Estado actualizado',data.mensaje)

      } catch (e) {
        console.warn(e);
      }
    },
    editarUsuarios(dato){
      this.$refs.modalEditarProveedor.toggle(dato);
    },
    async eliminandoUsuarios(){
      try {
        const {data} = await axios.delete(`${this.ruta}/${this.eliminarProv.id}/eliminar-proveedor`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al eliminar',data.error)
          return
        }
        this.$Helper.notificacion('success','Eliminado',data.mensaje)
        this.listar_usuarios()
        this.$refs.ModalEliminar.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    modalEliminar(dato){
      this.eliminarProv = dato
      this.$refs.ModalEliminar.toggle()
    },
    async listar_areas(){
      try {

        const {data} = await axios(`/api/select/listar-areas`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error Áreas',data.error)
          return
        }
        this.areas = data

      } catch (e) {
        return console.warn(e);
      }
    },
    async listar_usuarios(){
      try {
        const {data} = await axios(`${this.ruta}/listar-usuarios`)
        if (data.error) {
          this.$Helper.notificacion('warning','No es posible listar usuarios',data.error)
          return
        }

        data.forEach((ele, i)=>{
          ele.estado == 1?ele.estado_usuario = true:ele.estado_usuario = false
        })

        this.usuarios = data;

      } catch (e){
        console.warn(e);
      }
    },
    abrirCrearUsuario(){
      this.$refs.modalCrearProveedor.toggle();
    }
  }
}
</script>

<style lang="scss" scoped>

.listar-usuarios{
  .usuario-inactivo{
    opacity: 0.3
  }
  .card-padre{
    max-width: 246px;
    min-width: 246px;
    height: 340px;
    border: solid 1px #00000040;
    border-radius: 3px;
    text-align: center;
    transition-duration: .85s;
    .img-user{
      width: 150px;
      height: 150px;
      border-radius: 10px;
      box-shadow: 0px 2px 3px 0px #00000091;
      border: none;
    }
    .card-pie{
      margin-bottom: 4px;
      margin-top: -6px;
      .ver-mas{
        padding: 2px 5px 2px 6px;
        border-radius: 2px;
        font-size: 21px;
        background-color: midnightblue;
        color: white;
        cursor: pointer;
      }
    }
    .card-encabezado{
      margin-top: 5px;
      margin-bottom: -8px;
    }
    .card-acciones{
      width: 54px;
      position: absolute;
      right: 20px;
      top: 2px;
      font-size: 19px;
      visibility: hidden;
      transition-duration: .2s;
      .editar-user{
        cursor: pointer;
        border: solid 1px midnightblue;
        padding: 0px 2px 1px 1px;
        border-radius: 3px;
        color: midnightblue;
        &:hover{
          background-color: midnightblue;
          color: white;
        }
      }
      .eliminar-user{
        cursor: pointer;
        border: solid 1px midnightblue;
        padding: 0px 2px 1px 1px;
        border-radius: 3px;
        color: midnightblue;
        &:hover{
          background-color: midnightblue;
          color: white;
        }
      }
    }
    &:hover{
      box-shadow: 0px 0 7px 1px #1919708a;
      transition-duration: .4s;
      .card-acciones{
        visibility: visible;
        transition-duration: .4s;
      }
    }
  }
}
</style>
