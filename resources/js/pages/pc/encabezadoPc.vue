<template>
  <section class="encabezado-pc">
    <div>
      <b-tabs content-class="mt-3" justified >
        <b-tab title="Lista Chasis" @click="pest(1)"></b-tab>
        <b-tab title="Organizar PC" @click="pest(2)"></b-tab>
        <b-tab title="Eventos Torre" @click="pest(3)"></b-tab>
        <!-- <b-tab title="Disabled" disabled><p>I'm a disabled tab!</p></b-tab> -->
        <router-view />
      </b-tabs>
    </div>
  </section>
</template>
<script>
export default {
  name: "encabezadoPc",
  data(){
    return{
      // activeName: 'first',
      model: null
    }
  },
  methods: {
    pest(num){
      switch (num) {
        case 1:
          this.$router.push({
            name:'pc.listar'
          })
          break;
        case 2:
          this.$router.push({
            name:'pc.organizar'
          })
          break;
        case 3:
          this.$router.push({
            name:'eventos.pc'
          })
          break;
        default:
      }
    }
  }
}
</script>
<style lang="scss" scoped>
</style>
