<template >
    <section class="listar-areas">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h4 class="mt-3">Listado de áreas y roles</h4>
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
                    <el-collapse-item name="1">
                        <template slot="title">
                            <div class="row w-100">
                                <div class="col-1">
                                    <span class="item-areas">{{ a + 1}}</span>
                                </div>
                                <div class="col-6 ">
                                    <span class="letra-capital">{{data.area}}</span>
                                    <!-- <i class="header-icon el-icon-information"></i> -->
                                </div>
                                <div class="col-5 text-right">
                                    <i class="mdi mdi-pencil btn-editar-rol mr-1" @click.stop="abrirEditarArea(data)"></i>
                                    <i class="mdi mdi-delete btn-eliminar-rol mr-2" @click.stop="abrirEliminarArea(data)"></i>
                                    <i class="mdi mdi-plus btn-crear-rol ml-1" @click.stop=""></i>

                                </div>
                            </div>
                        </template>

                        <el-collapse v-for="(data2,r) in data.roles" :key="r">
                            <el-collapse-item name="1">
                                <template slot="title">
                                    {{data2.nombre_rol}}<i class="header-icon el-icon-information"></i>
                                    <i class="mdi mdi-pencil" @click.stop=""></i>
                                </template>

                            </el-collapse-item>
                        </el-collapse>

                    </el-collapse-item>
                </el-collapse>

            </div>
        </div>
        <modal-eliminar ref="modalEliminar"
          titulo="Eliminar Área"
          :cuerpo="`¿Seguro desea eliminar el área ${eliminar.area}?`"
          @eliminar="eliminarArea"
        />
        <editar-area ref="modalEditarArea" :ruta="ruta" @area:actualizada="listar_areas_roles" />
        <crear-area ref="modalCrearArea" :ruta="ruta" @area:creada="listar_areas_roles"/>
    </section>
</template>

<script>
export default {
  components:{
      EditarArea:()=>import('./components/editarArea'),
      CrearArea:()=>import('./components/crearArea'),
      ModalEliminar:()=>import('~/components/modales/modalEliminar')
  },
    data(){
        return{
            area:'',
            rol:'',
            ruta:'/api/administrar/areas',
            areas:[],
            value: 100,
            visible: false,
            eliminar:''
        }
    },
    mounted(){
        this.listar_areas_roles()
    },
    methods:{
      async eliminarArea(){
        try {
          const {data} = await axios.delete(`${this.ruta}/${this.eliminar.id}/eliminar-area`)
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
  p{
    margin-bottom: 0px;
  }
  .item-areas{
    border: solid 1px midnightblue;
    border-radius: 3px;
    padding: 2px 5px 2px 5px;
  }
  .btn-crear-rol{
    border: solid 1px midnightblue;
    border-radius: 3px;
    padding: 1px;
    color: midnightblue;
  }
  .btn-editar-rol{
    border: solid 1px midnightblue;
    border-radius: 3px;
    padding: 1px;
    color: midnightblue;
  }
  .btn-eliminar-rol{
    border: solid 1px midnightblue;
    border-radius: 3px;
    padding: 1px;
    color: midnightblue;
  }
  .el-collapse-item__header{
    background: none;
    .is-active{
      background-color: midnightblue;
      color: white;
    }
  }
}
</style>
