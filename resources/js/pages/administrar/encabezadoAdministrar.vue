<template >
  <section>
    <h3 class="mb-2 text-center">Administrables</h3>

    <el-tabs type="border-card" v-model="activeName" @tab-click="handleClick">
      <el-tab-pane
      v-for="(data,a) in administrar"
      :key="a"
      :label="data.nombre"
      :name="data.ruta"
      >
      <span slot="label"><i :class="data.icono"></i> {{data.nombre}}</span>
    </el-tab-pane>

    <router-view />
  </el-tabs>

</section>
</template>

<script>
export default {
  data(){
    return{
      activeName: '',
      administrar:[],
    }
  },
  mounted(){
    this.listar_administrables()
  },
  methods: {
    handleClick(tab, event) {
      this.$router.push({
        name:tab.name
      })
    },

    async listar_administrables(){
      try {
        const {data} = await axios(`/api/administrar/listar-administrar`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error administrables',data.error)
          return
        }
        this.administrar = data
      } catch (e) {
        console.warn(e,"error listar administrables");
      }
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
