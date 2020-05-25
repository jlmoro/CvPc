<template>
  <section class="listar-pcs">

    <h2>Principal pc</h2>

    <div>
      <b-tabs content-class="mt-3" justified>
        <b-tab title="First" active><p>I'm the first tab</p></b-tab>
        <b-tab title="Second"><p>I'm the second tab</p></b-tab>
        <b-tab title="Very, very long title"><p>I'm the tab with the very, very long title</p></b-tab>
        <b-tab title="Disabled" disabled><p>I'm a disabled tab!</p></b-tab>
      </b-tabs>
    </div>

    <modal-eliminar ref="modalEliminar"
    titulo="eliminar impresora"
    :cuerpo="`¿Seguro desea eliminar impresora con la placa ${eliminarPc.placa}?`"
    @eliminar="eliminandoPc"
    />

    <modal-crear ref="modalCrearPc" :ruta="ruta"
    @pc:creado="listar_pc"
    :encargados="encargados" :proveedores="proveedores"/>

    <modal-editar ref="modalEditarPc" :ruta="ruta"
    @pc:editado="listar_pc"
    :encargados="encargados" :proveedores="proveedores"/>

  </section>
</template>

<script>
export default {
  components:{
    ModalCrear:()=> import('./componentes/modalRegistrarPc'),
    ModalEditar:()=> import('./componentes/modalEditarPc')
  },
  data(){
    return{
      ruta:'/api/pc',
      pcs:[],
      search: '',
      encargados:[],
      proveedores:[],
      eliminarPc:'',
    }
  },
  mounted(){
    this.listar_pc()
    this.listarEncargados()
    this.listarProveedores()
  },
  computed:{
    listadoImpresoras(){
      return this.pcs.filter(data => !this.search || data.marca.toLowerCase().includes(this.search.toLowerCase()))
    }
  },
  methods:{
    async eliminandoPc(){
      try {
        const {data} = await axios.delete(`${this.ruta}/${this.eliminarPc.id}/eliminar-pc`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al eliminar impresora',data.error)
          return
        }
        this.$Helper.notificacion('success','Eliminado Correctamente',data.mensaje)

      } catch (e) {
        console.warn(e);
      } finally {
        this.listar_pc()
        this.$refs.modalEliminar.toggle()
      }
    },
    modalEliminar(dato){
      this.eliminarPc = dato
      this.$refs.modalEliminar.toggle()
    },
    crear_pc(){
      this.$refs.modalCrearPc.toggle()
    },
    async listar_pc(){
      try {
        const {data} = await axios(`${this.ruta}/listar-pc`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar',data.error)
          return
        }
        this.pcs = data
      } catch (e){
        console.warn(e);
      }
    },
    async listarEncargados() {
      try {
        const {data} = await axios(`/api/select/listar-encargados`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error listar encargados',data.error)
          return
        }
        this.encargados = data
      } catch (e) {
        console.warn(e);
      }
    },
    async listarProveedores() {
      try {
        const {data} = await axios(`/api/select/listar-proveedores`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error listar proveedores',data.error)
          return
        }
        this.proveedores = data
      } catch (e) {
        console.warn(e);
      }
    },
    modalEditar(dato){
      this.$refs.modalEditarPc.toggle(dato)
    }
  }
}
</script>

<style lang="scss" scoped>
.listar-pcs{
  .acciones{
    border-radius: 3px;
    padding: 1px 2px 1px 2px;
    color: white;
  }
  .btnEliminar{
    border: solid 1px #750303de;
    background-color: #750303de;
    transition-duration: .4;
    &:hover{
      color: #750303de;
      background-color: white;
      transition-duration: .85;
      cursor: pointer;
    }
  }
  .btnEditar{
    border: solid 1px #d28608cf;
    background-color: #d28608cf;
    transition-duration: .4;
    &:hover{
      color: #d28608cf;
      background-color: white;
      transition-duration: .85;
      cursor: pointer;
    }
  }
}
</style>
