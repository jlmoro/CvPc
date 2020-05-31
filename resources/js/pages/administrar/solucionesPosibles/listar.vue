<template>
  <section class="solucion-poible">

    <encabezadoDatos tituloEncabezado="Soluciones Posibles" tituloBoton="registrar solución" @accionBonton="modalRegistrarSolucion"/>

    <div class="row justify-content-center mt-4">
      <div class="col-md-7">
        <el-collapse v-for="(data,s) in listarSoluciones" :key="s" accordion>
          <div v-if="!data.length">
            <el-collapse-item :name="s + 1">
              <template slot="title">
                <div class="row w-100">
                  <div class="col-1">
                    <span class="item-secuencia">{{ s + 1}}</span>
                  </div>
                  <div class="col-8 ">
                    <span class="letra-capital">{{data.nombre_evento_tipo}}</span>
                    <!-- <i class="header-icon el-icon-information"></i> -->
                  </div>
                  <div class="col-3 text-right">
                    <i class="mdi mdi-pencil acciones btn-editar-solucion mr-1" @click.stop="modalEditarSolucion(data)"></i>
                    <i class="mdi mdi-delete acciones btn-eliminar-solucion mr-2" @click.stop="abrirModalEliminarTipo(data)"></i>
                  </div>
                </div>
              </template>
              <div class="row w-100">
                <div class="col-md-12">
                  <p class="">{{data.solucion_posible}}</p>
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

    <modal-eliminar ref="modalEliminarSol"
    titulo="eliminar solución posible"
    :cuerpo="` ¿Desea eliminar posible solución para el evento '${this.eliminarSol.nombre_evento_tipo}' ?`"
    @eliminar="eliminarSolucionPosible"
    />

    <crear-tipo ref="registrarSolucionPosible" @solucion:creada="listarSolucionesPosibles" :ruta="ruta" :tiposEventos="tiposEventos"/>
    <editar-tipo ref="editarSolucionPosible" @solucion:actualizada="listarSolucionesPosibles" :ruta="ruta" :tiposEventos="tiposEventos"/>

  </section>
</template>
<script>
export default {
  components:{
    CrearTipo:()=>import('./components/registrarSolucion'),
    EditarTipo:()=>import('./components/editarSolucionPosible'),
  },
  mounted() {
    this.eventosTipos()
    this.listarSolucionesPosibles()
  },
  data(){
    return{
      ruta:'/api/administrar/solucion-posible',
      dataEventosTipos:[],
      eliminarSol:'',
      listarSoluciones:[],
      tiposEventos:[],
    }
  },
  methods: {
    async eliminarSolucionPosible(){
      try {
        const {data} = await axios.delete(`${this.ruta}/${this.eliminarSol.id}/eliminar-solucion-posible`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al eliminar',data.error)
          return
        }
        this.$refs.modalEliminarSol.toggle()
        this.$Helper.notificacion('success','Eliminado',data.mensaje)
        this.listarSolucionesPosibles()
      } catch (e) {
        console.warn(e);
      }
    },
    async listarSolucionesPosibles(){
      try {
        const {data} = await axios(`${this.ruta}/listar-soluciones-posibles`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar',data.error)
          return
        }
        this.listarSoluciones = data

      } catch (e) {
        console.warn(e);
      }
    },
    async eventosTipos(){
      try {
        const {data} = await axios(`/api/select/listar-tipos-eventos`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar',data.error)
          return
        }
        this.tiposEventos = data

      } catch (e) {
        console.warn(e);
      }
    },
    abrirModalEliminarTipo(dato) {
      this.eliminarSol = dato
      this.$refs.modalEliminarSol.toggle()
    },
    modalRegistrarSolucion() {
      this.$refs.registrarSolucionPosible.toggle()
    },
    modalEditarSolucion(dato) {
      this.$refs.editarSolucionPosible.toggle(dato)
    }
  }
}
</script>
<style lang="scss" scoped>
.solucion-poible{
  .acciones{
    visibility: hidden;
  }
  .item-secuencia{
    border: solid 1px midnightblue;
    border-radius: 2px;
    padding: 1px 4px 1px 4px;
    color: midnightblue;
    margin-left: 6px;
  }
  .btn-editar-solucion{
    color: white;
    font-size: 18px;
    border: solid 1px white;
    border-radius: 3px;
    padding: 0px 1px 0px 1px;
    &:hover{
      background-color: midnightblue;
      color: #dea70a;
    }
  }
  .btn-eliminar-solucion{
    color: white;
    font-size: 18px;
    border: solid 1px white;
    border-radius: 3px;
    padding: 0px 1px 0px 1px;
    &:hover{
      background-color: midnightblue;
      color: #ef0000;
    }
  }
}
</style>
