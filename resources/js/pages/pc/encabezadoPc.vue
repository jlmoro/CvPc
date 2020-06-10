<template>
  <section class="encabezado-pc">
    <div>
      <b-tabs content-class="mt-3" justified >
        <b-tab title="Organizar PC" active @click="pest($event)"><p>I'm the first tab</p></b-tab>
        <b-tab title="Listar Torres"><p>I'm the second tab</p></b-tab>
        <b-tab title="Eventos Torre"><p>I'm the tab with the very, very long title</p></b-tab>
        <!-- <b-tab title="Disabled" disabled><p>I'm a disabled tab!</p></b-tab> -->
      </b-tabs>
    </div>
  </section>
</template>
<script>
export default {
  name: "encabezadoPc",
  data(){
    return{
      activeName: 'first',
      model: null
    }
  },
  methods: {
    pest(event){
      console.log(event,'pestañas 1');
    }
  }
}
</script>
<style lang="scss" scoped>
</style>
