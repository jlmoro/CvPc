<template>
  <section class="encabezado-pc">
    <div class="mb-5 text-center">
      <h5>Equipo</h5>
    </div>
    <div>
      <b-tabs content-class="mt-3" justified >
        <b-tab title="Chasis" @click="pest(1)"></b-tab>
        <b-tab title="Registrar PC" @click="pest(3)"></b-tab>
        <b-tab title="Listar PCs" @click="pest(2)"></b-tab>
        <b-tab title="Eventos PC" @click="pest(4)"></b-tab>
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
            name:'chasis.listar'
          })
          break;
        case 2:
          this.$router.push({
            name:'equipos.listar'
          })
          break;
        case 3:
          this.$router.push({
            name:'equipo.registrar'
          })
          break;
        case 4:
          this.$router.push({
            name:'eventospc.listar'
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
