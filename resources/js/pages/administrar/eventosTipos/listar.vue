<template>
  <section class="eventos-tipos" v-loading="isLoading">

    <encabezadoDatos tituloEncabezado="Tipos de Eventos" tituloBoton="nuevo tipo" @accionBonton="modalCrearTipoEvento"/>

    <div class="row justify-content-center">
        <div class="col-6">
            <el-collapse v-for="(data,e) in dataEventosTipos" :key="e" accordion>
              <div v-if="!data.length">
                <el-collapse-item :name="e + 1">
                    <template slot="title">
                        <div class="row w-100">
                            <div class="col-sm-1">
                                <span class="item-secuencia">{{ e + 1}}</span>
                            </div>
                            <div class="col-sm-7 ml-3 p-0">
                                <span class="letra-capital">{{data.nombre_tipo}}</span>
                                <!-- <i class="header-icon el-icon-information"></i> -->
                            </div>
                            <div class="col-sm-3 p-0 text-right">
                                <i class="mdi mdi-pencil acciones btn-editar-area mr-1" @click.stop="modalEditarTipoEvento(data)"></i>
                                <i class="mdi mdi-delete acciones btn-eliminar-area mr-2" @click.stop="abrirModalEliminarTipo(data)"></i>
                                <i class="mdi mdi-plus acciones btn-crear-rol ml-1" @click.stop="abrirCrearDescripcion(data)"></i>
                            </div>
                        </div>
                    </template>
                    <div class="row w-100">
                      <div class="col-md-12 text-center">
                        <div class="row">
                          <div class="col-md-12 text-center">
                            <span class="letra-capital f-16">{{data.sigla}}</span>
                          </div>
                        </div>
                        <!--<ul class="list-group" style="width:440px; float: right;">-->
                        <ul class="list-group ml-3 pl-3">
                          <li v-if="data.descripcion" v-for="(data2,r) in data.descripcion" :key="r" class="list-group-item">
                            <div class="row">
                              <div class="col-md-1">
                                <span class="item-rol">{{r + 1}}</span>
                              </div>
                              <div class="col-md-8">
                                <span class="letra-capital nombre-rol">{{data2.nombre}}</span>
                              </div>
                              <div class="col-md-3">
                                <!--<i class="mdi mdi-pencil btn-editar-rol mr-1" @click.stop="abrirEditarRol(data2)"></i>
                                <i class="mdi mdi-delete btn-eliminar-rol" @click.stop="abrirEliminarRol(data2)"></i>-->
                              </div>
                            </div>
                          </li>
                          <div v-else class="">
                            <span class="">Sin registros !</span>
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

    <modal-eliminar ref="modalEliminarTipoE"
    titulo="eliminar tipo evento"
    :cuerpo="` ¿Desea eliminar el tipo de evento '${this.eliminarTipo.nombre_tipo}' ?`"
    @eliminar="eliminarTipoEvento"
    />

    <crear-tipo ref="crearTipoEvento" @eventoTipo:creado="listarEventosTipos" :ruta="ruta"/>
    <editar-tipo ref="editarTipoEvento" @eventoTipo:actualizado="listarEventosTipos" :ruta="ruta"/>
    <crear-tipo-evento-descripcion ref="crearTipoDescripcion" @eventoTipo:creado="listarEventosTipos" :ruta="ruta"/>

  </section>
</template>
<script>
export default {
  components:{
    CrearTipo:()=>import('./components/crearTipoEvento'),
    EditarTipo:()=>import('./components/editarTipoEvento'),
    crearTipoEventoDescripcion:()=>import('./components/crearTipoEventoDescripcion'),
  },

  data(){
    return{
      ruta:'/api/administrar/eventos-tipos',
      dataEventosTipos:[],
      eliminarTipo:'',
      isLoading:false
    }
  },
  mounted() {
    this.isLoading = true
    Promise.all([
      this.listarEventosTipos()
    ]).then(res => {
      this.isLoading = false
    })
  },
  methods: {

    async listarEventosTipos(){
      try {
        const {data} = await axios(`${this.ruta}/listar-eventos`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar',data.error)
          return
        }
        this.dataEventosTipos = data
      } catch (e) {
          console.warn(e);
      }
    },
    async eliminarTipoEvento(){
      try {
        const {data} = await axios.delete(`${this.ruta}/${this.eliminarTipo.id}/eliminar-evento-tipo`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al eliminar',data.error)
          return
        }
        this.$refs.modalEliminarTipoE.toggle()
        this.$Helper.notificacion('success','Eliminado',data.mensaje)
        this.listarEventosTipos()
      } catch (e) {
        console.warn(e);
      }
    },
    abrirCrearDescripcion(dato){
      this.$refs.crearTipoDescripcion.toggle(dato)
    },
    abrirModalEliminarTipo(dato) {
      this.eliminarTipo = dato
      this.$refs.modalEliminarTipoE.toggle()
    },
    modalCrearTipoEvento() {
      this.$refs.crearTipoEvento.toggle()
    },
    modalEditarTipoEvento(dato) {
      this.$refs.editarTipoEvento.toggle(dato)
    }
  }
}
</script>
<style lang="scss" scoped>
.eventos-tipos{
  .cantidad{
    padding: 0px 4px 0px 4px;
    border: solid 1px midnightblue;
    border-radius: 3px;
    color: midnightblue;
  }
  .eliminar, .editar{
    border: solid 1px midnightblue;
    border-radius: 3px;
    padding: 1px 2px 1px 2px;
    color: midnightblue;
    &:hover{
      cursor: pointer;
    }
  }
  .lista-eventos-tipos{
    &:hover{
      background: midnightblue;
      color: white;
      .eliminar, .editar, .cantidad{
        border: solid 1px white;
        color: white;
      }
    }
  }

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
