<template>
  <section class="listar-proveedores mb-5" v-loading="isLoading">

    <encabezado-datos tituloEncabezado="Proveedores" tituloBoton="nuevo proveedor" @accionBonton="abrirCrearProveedor"/>

      <div class="row justify-content-center">
        <div class="col-md-4 text-center" v-for="(data,e) in proveedores" :key="e">

          <div class="container">
            <div class="card-acciones mb-1 text-right">
              <span class="mdi mdi-pencil editar-user" @click="editarProveedores(data)"></span>
              <span class="mdi mdi-delete eliminar-user" @click="modalEliminar(data)"></span>
            </div>
            <b-card  no-body style="max-width: 20rem;" img-top >
              <template v-slot:header>
                <img v-if="data.logo != null" :src="`/storage/${data.logo}`" alt="" class="img-user">
                <img v-else src="img/user_default.jpg" class="img-user" alt="">
                <h5 class="mb-0 letra-capital mt-3 text-center">
                  {{data.nombre_proveedor}}
                </h5>
              </template>
              <b-list-group flush>
                <b-list-group-item>{{data.telefono}}</b-list-group-item>
                <b-list-group-item>{{data.direccion}}</b-list-group-item>
              </b-list-group>
              <b-card-footer>
                <!-- <span class="mdi mdi-magnify ver-mas"></span> -->
              </b-card-footer>
            </b-card>
          </div>

          </div>
        </div>

    <modal-crear ref="modalCrearProveedor" :ruta="ruta" @proveedor:creado="listar_proveedores"/>
    <modal-editar ref="modalEditarProveedor" :ruta="ruta" @proveedor:actualizado="listar_proveedores"/>

    <modal-eliminar ref="ModalEliminar"
    titulo="eliminar proveedor"
    :cuerpo="`¿Desea eliminar el proveedor ${eliminarProv.nombre_proveedor}?`"
    @eliminar="eliminandoProveedor"
    />
  </section>
</template>

<script>
export default {
  components: {
    ModalCrear:()=> import('./componentes/modalCrearProveedor'),
    ModalEditar:()=> import('./componentes/modalEditarProveedor')
  },
  data(){
    return{
      ruta:'/api/proveedores',
      proveedores:[],
      eliminarProv:'',
      isLoading:false,
    }
  },
  mounted(){
    this.isLoading = true
    Promise.all([
      this.listar_proveedores()
    ]).then(res=>{
      this.isLoading = false
    })
  },
  methods:{
    editarProveedores(dato){
      this.$refs.modalEditarProveedor.toggle(dato);
    },
    async eliminandoProveedor(){
      try {
        const {data} = await axios.delete(`${this.ruta}/${this.eliminarProv.id}/eliminar-proveedor`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al eliminar',data.error)
          return
        }
        this.$Helper.notificacion('success','Eliminado',data.mensaje)
        this.listar_proveedores()
        this.$refs.ModalEliminar.toggle()
      } catch (e) {
        console.warn(e);
      }
    },
    modalEliminar(dato){
      this.eliminarProv = dato
      this.$refs.ModalEliminar.toggle()
    },
    async listar_proveedores(){
      try {
        const {data} = await axios(`${this.ruta}/listar-proveedores`)
        //notificacion si falla
        this.proveedores = data;

      } catch (e){
        console.warn(e);
      }
    },
    abrirCrearProveedor(){
      this.$refs.modalCrearProveedor.toggle();
    }
  }
}
</script>

<style lang="scss" scoped>

.listar-proveedores{
  .container{

    transition-duration: .85s;
    .card-acciones{
      visibility: hidden;
      // transition-duration: .5s;
      .editar-user{
        border: 1px solid;
        border-radius: 3px;
        padding: 0px 1px 0px 1px;
        color: #c77107;
        transition-duration: .85s;
        &:hover{
          transition-duration: .4s;
          background-color: #c77107;
          color: white;
          cursor: pointer;
        }
      }
      .eliminar-user{
        border: 1px solid #920b0b;
        border-radius: 3px;
        padding: 0px 1px 0px 1px;
        color: #920b0b;
        transition-duration: .85s;
        &:hover{
          transition-duration: .4s;
          background-color: #920b0b;
          color: white;
          cursor: pointer;
        }
      }
    }

    &:hover{
      transition-duration: .4s;
      .card{
        box-shadow: 0px 0 7px 1px #1919708a;
        transition-duration: .10s;
      }
      .card-acciones{
        visibility: visible;
        // transition-duration: .4s;
      }
    }
  }

  .img-user{
    width: 150px;
    height: 150px;
    border-radius: 10px;
    box-shadow: 0px 1px 2px 0px #00000091;
    border: none;
  }


}
</style>
