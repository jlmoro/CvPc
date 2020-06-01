<template>
  <section class="menu-principal">
    <div v-show="user" class="">

    <!-- <span class="mdi mdi-backburger f-40 icono-menu" :style="rotarIcono" @click="openClose"></span> -->
    <div class="row">
      <div class="col-md-12 text-center">
        <img v-show="isCollapse !== true" src="/img/logo_dark2.png" class="logo-menu" />
        <span v-if="isCollapse == true" class="mdi mdi-arrow-right f-18 icono-menu" @click="openClose"></span>

        <span v-else class="mdi mdi-arrow-left f-18 icono-menu" @click="openClose"></span>
      </div>
    </div>
    <!-- <el-menu class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" :collapse="isCollapse"> -->
    <el-menu class="el-menu-vertical-demo" :router="true"
    :collapse="isCollapse" >
    <el-submenu v-for="(data,m) in dataMenu" :key="m" :index="`${m + 1}`" @change="loDelMenu(data)">
      <template slot="title">
        <i :class="`${data.icono} f-16`"></i>
        <span slot="title" class="letra-capital f-16">{{data.nombre}}</span>
      </template>
      <!-- <el-menu-item v-for="(data2,i) in data.items" :key="i" :index="`${i + 1}`" :click="verDato(data2)"> -->
      <el-menu-item v-for="(data2,i) in data.items" :key="i" :index="data.ruta" :route="data2.ruta" >
        <span :class="`${data2.icono} f-16`"></span>
        <span class="letra-capital f-16">{{data2.nombre}}</span>
      </el-menu-item>
    </el-submenu>

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
  mounted() {
    this.listar_menu();
  },
  computed: mapGetters({ user: 'auth/user' }),
  watch:{
    listandoMenu(a,b){
      console.log(a,b,"valores a y b");
      if(this.user){
        this.listar_menu();
      }
    }
  },
  methods: {
    loDelMenu(dato){
      // console.log(dato,"el change ese del menú");
    },
    verDato(dato){
      // console.log(dato,"datoooooooooooo");
    },
    openClose(){
      if (this.isCollapse == true) {
        this.isCollapse = false
      }else {
        this.isCollapse = true
      }
    },

    async listar_menu() {
      try {
        // console.log(this.user,"en el metodo de listar menu");

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
  .logo-menu{
    width: 62px;
    margin-top: 10px;
  }
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
