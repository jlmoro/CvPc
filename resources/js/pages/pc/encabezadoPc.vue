<template>
  <section class="encabezado-pc">
    <div>
      <b-tabs content-class="mt-3" justified >
        <b-tab title="Chasis" @click="pest(1)"></b-tab>
        <b-tab title="Fuente Poder" @click="pest(2)"></b-tab>
        <b-tab title="Procesadores" @click="pest(3)"></b-tab>
        <b-tab title="Memorias RAM" @click="pest(4)"></b-tab>
        <b-tab title="Placas Base" @click="pest(5)"></b-tab>
        <b-tab title="Disco SSD/HDD" @click="pest(6)"></b-tab>
        <b-tab title="Prifericos" @click="pest(7)"></b-tab>
        <b-tab title="Equipo" @click="pest(8)"></b-tab>
        <b-tab title="Eventos Torre" @click="pest(9)"></b-tab>
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
            name:'fuentes.listar'
          })
          break;
        case 3:
          this.$router.push({
            name:'procesador.listar'
          })
          break;
        case 4:
          this.$router.push({
            name:'ram.listar'
          })
          break;
        case 5:
          this.$router.push({
            name:'board.listar'
          })
          break;
        case 6:
          this.$router.push({
            name:'disco.listar'
          })
          break;
        case 7:
          this.$router.push({
            name:'perife.listar'
          })
          break;
        case 8:
          this.$router.push({
            name:'organizar.listar'
          })
          break;
        case 9:
          this.$router.push({
            name:''
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
