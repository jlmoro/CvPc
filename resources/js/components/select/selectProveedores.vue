<template>
  <section class="lista-encargados">
    <el-select v-model="value" filterable placeholder="Seleccione Encargado" clearable>
      <el-option
        v-for="(item,p) in proveedores"
        :key="p"
        :label="item.nombre"
        :value="item.id">
      </el-option>
    </el-select>
  </section>
</template>
<script>
export default {
  name: "selectProveedores",
  data(){
    return{
      proveedores:[],
      value: '',
    }
  },
  created() {
    this.listarProveedores()
  },
  methods: {
    async listarProveedores() {
      try {
        const {data} = await axios(`/api/select/listar-proveedores`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error listar proveedores',data.error)
          return
        }
        this.proveedores = data
        this.$emit('proveedor',data)
      } catch (e) {
        console.warn(e);
      }
    }
  }
}
</script>
<style lang="scss" scoped>
.lista-encargados{

}
</style>
