<template>
  <section class="menu-principal">
    <div v-show="user" class="">


    <!-- <span class="mdi mdi-backburger f-40 icono-menu" :style="rotarIcono" @click="openClose"></span> -->
    <span class="mdi mdi-backburger f-40 icono-menu" @click="openClose"></span>
    <!-- <el-menu class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" :collapse="isCollapse"> -->
    <el-menu class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" :router="true"
    :collapse="isCollapse">
    <el-submenu v-for="(data,m) in dataMenu" :key="m" :index="`${m + 1}`" >
      <template slot="title">
        <i :class="`${data.icono} f-16`"></i>
        <span slot="title" class="letra-capital f-16">{{data.nombre}}</span>
      </template>
      <!-- <el-menu-item v-for="(data2,i) in data.items" :key="i" :index="`${i + 1}`" :click="verDato(data2)"> -->
      <el-menu-item v-for="(data2,i) in data.items" :key="i" :index="data.ruta" :route="data2.ruta">
        <span :class="`${data2.icono} f-16`"></span>
        <span class="letra-capital f-16">{{data2.nombre}}</span>
      </el-menu-item>
    </el-submenu>
    <el-menu-item v-if="dataMenu.items == null" index="4" >
      <i class="el-icon-setting"></i>
      <span slot="title">Navigator Four</span>
    </el-menu-item>

  </el-menu>
  </div>

</section>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
  name: "MenuCvpc",
  data(){
    return{
      dataMenu:[],
      isCollapse: true,
    }
  },
  created() {
    this.listar_menu();
  },
  computed: mapGetters({ user: 'auth/user' }),
    // rotarIcono(){
    //   if (this.isCollapse === true) {
    //     return {
    //       color: '#a94442',
    //     }
    //   }
    // }

  methods: {
    verDato(dato){
      console.log(dato,"datoooooooooooo");
    },
    openClose(){
      console.log("en openClose");
      if (this.isCollapse == true) {
        console.log("es true");
        this.isCollapse = false
      }else {
        console.log("es false");
        this.isCollapse = true
      }
      // ?false:true
    },
    handleOpen(key, keyPath) {
      console.log(key, keyPath);
    },
    handleClose(key, keyPath) {
      console.log(key, keyPath);
    },
    async listar_menu() {
      try {
        const {data} = await axios(`/api/menu-principal/listar-menu`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error Menu',data.error)
          return
        }
        this.dataMenu = data
      } catch (e) {
        console.warn(e);
      }
    }
  }
}
</script>
<style lang="scss" scoped>
.menu-principal{
  .icono-menu{
    .rotar-icono{

    }
  }
  .el-menu-vertical-demo:not(.el-menu--collapse) {
    width: 200px;
    min-height: 400px;
  }
}
</style>
