<template>
  <section class="crear-impresora">
    <modal ref="ModalCrearImpresora">
      <div slot="header" class="row">
        <div class="col-12">
          <span class="letra-capital">crear impresora</span>
        </div>
      </div>
      <div slot="body" class="row">
        <div class="col-12">
          <div class="row w-100">
            <div class="col-md-6">
              <label for="" class="letra-capital">marca</label>
              <input type="text" class="input-general">
            </div>
          </div>
          <select-encargados @encargados="listaEncargados(data)"/>
          <select-proveedores @proveedor="listaProveedores(data)"/>
        </div>
      </div>
      <div slot="footer" class="row">
        <div class="col-12">
          <button type="button" class="btn-crear">Guardar</button>
          <button type="button" class="btn-cancelar" @click="toggle">Cancelar</button>
        </div>
      </div>
    </modal>
  </section>
</template>

<script>
export default {
  components:{
    Modal:()=> import('~/components/modales/modalB')
  },
  data(){
    return{

    }
  },
  methods:{
    listaEncargados(data){
      console.log(data,'datos encargado')
    },
    toggle(){
      this.$refs.ModalCrearImpresora.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
