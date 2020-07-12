<template >
    <section class="listar-areas" v-loading="isLoading">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h5 class="mt-3">Listado de áreas y roles</h5>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-right">
            <button type="button" name="button" class="btn-crear" @click="abrirCrearArea">
              <span class="mdi mdi-plus"></span>
              Crear Área
            </button>
          </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-6">
                <el-collapse v-for="(data,a) in areas" :key="a" accordion>
                  <div v-if="!data.length">
                    <el-collapse-item :name="a + 1">
                        <template slot="title">
                            <div class="row w-100">
                                <div class="col-1">
                                    <span class="item-secuencia">{{ a + 1}}</span>
                                </div>
                                <div class="col-6 ">
                                    <span class="letra-capital">{{data.area}}</span>
                                    <!-- <i class="header-icon el-icon-information"></i> -->
                                </div>
                                <div class="col-5 text-right">
                                    <i class="mdi mdi-pencil acciones btn-editar-area mr-1" @click.stop="abrirEditarArea(data)"></i>
                                    <i class="mdi mdi-delete acciones btn-eliminar-area mr-2" @click.stop="abrirEliminarArea(data)"></i>
                                    <i class="mdi mdi-plus acciones btn-crear-rol ml-1" @click.stop="abrirCrearRol(data)"></i>
                                </div>
                            </div>
                        </template>
                        <div class="row w-100">
                          <div class="col-md-12">
                            <!-- <ul class="list-group" style="width:440px; float: right;"> -->
                            <ul class="list-group" >
                              <li v-if="data.roles" v-for="(data2,r) in data.roles" :key="r" class="list-group-item">
                                <div class="row">
                                  <div class="col-md1">
                                    <span class="item-rol">{{r + 1}}</span>
                                  </div>
                                  <div class="col-md-8">
                                    <span class="letra-capital nombre-rol">{{data2.nombre_rol}}</span>
                                  </div>
                                  <div class="col-md-3">
                                    <i class="mdi mdi-pencil btn-editar-rol mr-1" @click.stop="abrirEditarRol(data2)"></i>
                                    <i class="mdi mdi-delete btn-eliminar-rol" @click.stop="abrirEliminarRol(data2)"></i>
                                  </div>
                                </div>
                              </li>
                              <div v-else class="">
                                <span class="color-principal">Sin registros !</span>
                              </div>
                            </ul>
                          </div>
                        </div>

                    </el-collapse-item>
                    </div>
                    <div v-else>
                      <h5>Sin registros !</h5>
                    </div>
                </el-collapse>
            </div>
        </div>
        <modal-eliminar ref="modalEliminar"
          titulo="Eliminar Área"
          :cuerpo="`¿Seguro desea eliminar el área ${eliminar.area}?`"
          @eliminar="eliminarArea"
        />
        <modal-eliminar ref="modalEliminarRol"
          :titulo="`Eliminar Rol`"
          :cuerpo="`¿Seguro desea eliminar el rol ${eliminarRol.nombre_rol}?`"
          @eliminar="eliminar_rol"
        />
        <editar-area ref="modalEditarArea" :ruta="ruta" @area:actualizada="listar_areas_roles" />
        <crear-area ref="modalCrearArea" :ruta="ruta" @area:creada="listar_areas_roles"/>
        <crear-rol ref="modalCrearRol" :ruta="ruta" @rol:creado="listar_areas_roles"/>
        <editar-rol ref="modalEditarRol" :ruta="ruta" @rol:editado="listar_areas_roles"/>
    </section>
</template>

<script>
export default {
  components:{
      EditarArea:()=>import('./components/editarArea'),
      EditarRol:()=>import('./components/editarRol'),
      CrearArea:()=>import('./components/crearArea'),
      CrearRol:()=>import('./components/crearRol'),
      ModalEliminar:()=>import('~/components/modales/modalEliminar')
  },
    data(){
        return{
            area:'',
            rol:'',
            ruta:'/api/administrar/areas',
            areas:[],
            visible: false,
            eliminar:'',
            eliminarRol:'',
            isLoading:false,
        }
    },
    mounted(){
      this.isLoading = true
      Promise.all([
        this.listar_areas_roles()
      ]).then(res => {
        this.isLoading = false
      })
    },
    methods:{
      async eliminar_rol(){
        try {
          const {data} = await axios.delete(`${this.ruta}/${this.eliminarRol.id}/eliminar-rol`)
          if (data.eror) {
            this.$Helper.notificacion('warning','Error al eliminar','No es posible eliminar rol')
            return
          }
          this.$Helper.notificacion('success','Rol Eliminado',data.mensaje)
          this.listar_areas_roles()
          this.$refs.modalEliminarRol.toggle()
        } catch (e) {
          console.warn(e);
        }
      },
      abrirEliminarRol(dato){
        this.eliminarRol = dato
        this.$refs.modalEliminarRol.toggle();
      },
      async eliminarArea(){
        try {
          const {data} = await axios.delete(`${this.ruta}/${this.eliminar.id}/eliminar-area`)
          if (data.eror) {
            this.$Helper.notificacion('warning','Error al eliminar',data.error)
            return
          }
          this.$Helper.notificacion('success','Área Guardada',data.mensaje)
          this.listar_areas_roles()
          this.$refs.modalEliminar.toggle()
        } catch (e) {
          console.warn(e);
        }
      },
      abrirEliminarArea(data){
        this.eliminar = data
        this.$refs.modalEliminar.toggle();
      },
      abrirCrearArea(){
        this.$refs.modalCrearArea.toggle()
      },
      abrirEditarArea(dato){
        this.$refs.modalEditarArea.toggle(dato)
      },
      abrirCrearRol(datos){
        this.$refs.modalCrearRol.toggle(datos)
      },
      abrirEditarRol(dato){
        this.$refs.modalEditarRol.toggle(dato)
      },
      async listar_areas_roles(){
        try {
          const {data} = await axios(`${this.ruta}/listar-areas`)
          this.areas = data
        } catch (e) {
          console.warn(e);
        }
      }
    }
}
</script>

<style lang="scss" scoped>
.listar-areas{
  .list-group-item{
    &:hover{
      background-color: midnightblue;
      .nombre-rol{
        color: white;
      }
      .item-rol{
        border: solid 1px white;
        color: white;
      }
      .btn-editar-rol, .btn-eliminar-rol{
        border: solid 1px white;
        color: white;
      }
    }
  }
  p{
    margin-bottom: 0px;
  }
  .item-secuencia{
    border: solid 1px midnightblue;
    border-radius: 3px;
    padding: 2px 5px 2px 5px;
    margin-left: 6px;
  }
  .item-rol{
    border: solid 1px midnightblue;
    border-radius: 3px;
    padding: 2px 5px 2px 5px;
  }
  .acciones{
    visibility: hidden;
  }
  .btn-crear-rol{
    border: solid 1px white;
    border-radius: 3px;
    padding: 1px;
    color: white;
  }
  .btn-editar-area{
    border: solid 1px white;
    border-radius: 3px;
    padding: 1px;
    color: white;
    cursor: pointer;
  }
  .btn-eliminar-area{
    border: solid 1px white;
    border-radius: 3px;
    padding: 1px;
    color: white;
    cursor: pointer;
  }
  .btn-editar-rol{
    border: solid 1px midnightblue;
    border-radius: 3px;
    padding: 1px;
    color: midnightblue;
    cursor: pointer;
  }
  .btn-eliminar-rol{
    border: solid 1px midnightblue;
    border-radius: 3px;
    padding: 1px;
    color: midnightblue;
    cursor: pointer;
  }
}
</style>
