<template>
  <section class="listar-impresoras">
    <encabezado-datos tituloEncabezado="Impresoras" tituloBoton="registrar impresora" @accionBonton="crear_impresora"/>

    <modal-crear ref="modalCrearImpresora"/>
  </section>
</template>

<script>
export default {
  components:{
    ModalCrear:()=> import('./componentes/modalRegistrarImpresora')
  },
  data(){
    return{
      ruta:'/api/impresora',
      impresoras:[]
    }
  },
  mounted(){
    this.listar_impresoras()
  },
  methods:{
    crear_impresora(){
      this.$refs.modalCrearImpresora.toggle()
    },
    async listar_impresoras(){
      try {
        const {data} = await axios(`${this.ruta}/listar-impresoras`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error al listar',data.error)
          return
        }
        this.impresoras = data

      } catch (e){
        console.warn(e);
      }
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
