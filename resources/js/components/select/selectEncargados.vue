<template>
  <section class="lista-encargados">
    <el-select v-model="value" filterable placeholder="Seleccione Encargado" clearable @change="$emit('encargados',$event)">
      <el-option
        v-for="(item,e) in encargados"
        :key="e"
        :label="item.nombre"
        :value="item.id">
      </el-option>
    </el-select>
  </section>
</template>
<script>
export default {
  name: "selectEncargados",
  props: ['encargados'],
  data(){
    return{
      // encargados:[],
      value: '',
    }
  },
  created() {
    // this.listarEncargados()
  },
  methods: {
    // async listarEncargados() {
    //   try {
    //     const {data} = await axios(`/api/select/listar-encargados`)
    //     if (data.error) {
    //       this.$Helper.notificacion('warning','Error listar encargados',data.error)
    //       return
    //     }
    //     this.encargados = data
    //   } catch (e) {
    //     console.warn(e);
    //   }
    // }
  }
}
</script>
<style lang="scss" scoped>
.lista-encargados{

}
</style>
