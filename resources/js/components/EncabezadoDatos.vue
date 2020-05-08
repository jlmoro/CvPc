<template>
  <section class="encabezado-datos">
    <div class="row mb-4">
      <div class="col-12 text-center">
        <h5 class="mt-3">{{tituloEncabezado}}</h5>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-12 text-right">
        <button type="button" class="btn-crear" @click="$emit('accionBonton')">
          <span class="mdi mdi-plus"></span>
          <span class="letra-capital">{{tituloBoton}}</span>
        </button>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  name: "encabezadoDatos",
  props: [
    'tituloEncabezado',
    'tituloBoton'
  ],
  data(){
    return{

    }
  }
}
</script>
<style lang="scss" scoped>
</style>
