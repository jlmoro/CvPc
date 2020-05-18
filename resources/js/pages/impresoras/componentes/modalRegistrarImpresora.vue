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
          <select-encargados @encargados="agregaEncargado"/>
          <select-proveedores @proveedor="agregaProveedor"/>
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
      form:{
        encargado:null,
        proveedor:null,
      }
    }
  },
  methods:{
    agregaEncargado(data){
      this.form.encargado = data
    },
    agregaProveedor(data){
      this.form.proveedor = data
    },
    toggle(){
      this.$refs.ModalCrearImpresora.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
