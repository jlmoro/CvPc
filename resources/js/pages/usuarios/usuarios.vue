<template>
  <section class="listar-usuarios mb-5">

    <encabezado-datos tituloEncabezado="Usuarios" tituloBoton="Crear Usuario" @accionBonton="abrirCrearUsuario"/>

    <div class="row" v-loading="isLoading">
      <div v-for="(data,e) in usuarios" :key="e" class="col-md-3">
        <div class="card-padre">
          <div class="row">
            <div class="col-md-12 card-encabezado">
              <span class="letra-capital f-16">{{data.documento}}</span>
              <div class="card-acciones">
                <span class="mdi mdi-pencil editar-user" @click="editarUsuarios(data)"></span>
                <span class="mdi mdi-delete eliminar-user" @click="modalEliminar(data)"></span>
              </div>
            </div>
          </div>
          <hr style="border-top-color: #0000003b;">
          <div class="row">
            <div class="col-md-12">
              <img v-if="data.logo != null"  class="img-user" :src="`/storage/${data.foto}`"/>
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

    <modal-crear ref="modalCrearProveedor" :ruta="ruta" @proveedor:creado="listar_usuarios"/>
    <modal-editar ref="modalEditarProveedor" :ruta="ruta" @proveedor:actualizado="listar_usuarios"/>

    <modal-eliminar ref="ModalEliminar"
    titulo="eliminar proveedor"
    :cuerpo="`¿Desea eliminar el proveedor ${eliminarProv.nombre_proveedor}?`"
    @eliminar="eliminandoUsuarios"
    />
  </section>
</template>

<script>
export default {
  components: {
    ModalCrear:()=> import('./componentes/modalCrearUsuarios'),
    ModalEditar:()=> import('./componentes/modalEditarUsuarios')
  },
  data(){
    return{
      ruta:'/api/usuarios',
      usuarios:[],
      eliminarProv:'',
      isLoading:false,
    }
  },
  mounted(){
    this.isLoading = true
    Promise.all([
      this.listar_usuarios()
    ]).then(res=>{
      this.isLoading = false
    })
  },
  methods:{
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
    async listar_usuarios(){
      try {
        const {data} = await axios(`${this.ruta}/listar-usuarios`)
        //notificacion si falla
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
  .card-padre{
    width: 246px;
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
