<template >
  <section class="listar-encargados">
    <div class="row mb-4">
      <div class="col-12 text-center">
        <h5 class="mt-3">Listado de encargados</h5>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-12 text-right">
        <button type="button" class="btn-crear" @click="crear_encargado">
          <span class="mdi mdi-plus"></span>
          Nuevo Encargado
        </button>
      </div>
    </div>

    <div class="row">
      <div v-for="(data,e) in encargados" :key="e" class="col-md-3">
        <div class="card-padre">
          <div class="row">
            <div class="col-md-12 card-encabezado">
              <span class="letra-capital f-16">{{data.documento}}</span>
              <div class="card-acciones">
                <span class="mdi mdi-pencil editar-user" @click="editarEncargado(data)"></span>
                <span class="mdi mdi-delete eliminar-user" @click="modalEliminar(data)"></span>
              </div>
            </div>
          </div>
          <hr style="border-top-color: #0000003b;">
          <div class="row">
            <div class="col-md-12">
              <img v-if="data.foto != null"  class="img-user" :src="`/storage/${data.foto}`"/>
              <img v-else class="img-user" src="/storage/encargados/3919470415eb1e6ce8a0b15.069863140.565430001588717262.png"/>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <span class="letra-capital f-14">{{data.nombre_completo}}</span> -
              <span class="f-12">{{data.telefono}}</span>
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
    <modal-eliminar ref="modalEliminarEncargado"
      titulo="eliminar encargado"
      :cuerpo="`¿Desea eliminar el encargado(a) ${eliminarE.nombre_completo}?`"
      @eliminar="eliminandoE"
    />
    <crear-encargado ref="modalCrearEncargado" :areas="lista_areas" :ruta="ruta" @encargado:creado="listar_encargados" />
    <editar-encargado ref="modalEditarEncargado" :areas="lista_areas" :ruta="ruta" @encargado:actualizado="listar_encargados" />
  </section>
</template>

<script>
export default {
  components:{
    CrearEncargado:()=>import('./components/CrearEncargado'),
    EditarEncargado:()=>import('./components/EditarEncargado'),
    // ModalEliminar:()=>import('~/components/Modales/modalEliminar')
  },
  data(){
    return{
      ruta:'/api/administrar/encargados',
      area:null,
      lista_areas:[],
      encargados:[],
      dialogFormVisible: false,
      eliminarE:''
    }
  },
  mounted(){
    this.listar_areas()
    this.listar_encargados()
  },
  methods:{
    async eliminandoE(){
      try {
        const {data} = await axios.delete(`${this.ruta}/${this.eliminarE.id}/eliminar-encargado`)
        if (data.error) {
          if (data.error) {
            this.$Helper.notificacion('warning','Error al eliminar',data.error)
            return
          }
          this.listar_encargados()
        }

      } catch (e) {
        console.warn(e);
      }
    },
    modalEliminar(data){
      this.eliminarE = data
      this.$refs.modalEliminarEncargado.toggle()
    },
    editarEncargado(datos){
      this.$refs.modalEditarEncargado.toggle(datos)
    },
    crear_encargado(){
      this.$refs.modalCrearEncargado.toggle()
    },
    async listar_encargados(){
      try {
        const {data} = await axios(`${this.ruta}/listar-encargados`)
        if (data.error) {
          this.$Helper.notificacion('error','Error',data.error)
          return
        }
        this.encargados = data

      } catch (e){
        console.warn(e);
      }
    },
    async listar_areas(){
      try {
        const {data} = await axios(`/api/select/listar-areas`)
        if (data.error) {
          this.$Helper.notificacion('error','Error',data.error)
          return
        }
        this.lista_areas = data
      } catch (e) {
        console.warn(e);
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.listar-encargados{
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
