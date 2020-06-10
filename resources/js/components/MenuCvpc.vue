<template>
  <section class="menu-principal">
    <div v-show="user" class="">

    <div class="row">
      <div class="col-md-12 text-center">
        <img v-show="isCollapse !== true" src="/img/logo_dark2.png" class="logo-menu" />
        <span v-if="isCollapse == true" class="mdi mdi-menu f-18 icono-menu1" @click="openClose"></span>

        <span v-else class="mdi mdi-arrow-left f-18 icono-menu" @click="openClose"></span>
      </div>
    </div>

    <el-menu class="el-menu-vertical-demo"
    :collapse="isCollapse">
    <el-submenu v-for="(data,m) in dataMenu" :key="m" :index="`${m + 1}`" @click="loDelMenu(data)">
      <template slot="title">
        <i :class="`${data.icono}`" class="f-16"></i>
        <span slot="title" class="letra-capital f-16">{{data.nombre}}</span>
      </template>

      <el-menu-item v-for="(data2,i) in data.items" :key="i" @click="loDelMenu(data2)">
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
      //dataMenu:[],
      isCollapse: true,
      listandoMenu:''
    }
  },
  computed:{
    ...mapGetters({
      user: 'auth/user',
      dataMenu: 'menu/getMenu'
    }),
    mitoracomputada(){
      return 'hola'
    }
  },
  methods: {
    loDelMenu(dato){
      this.$router.push({
        name:`${dato.ruta}`
      })
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
  .icono-menu1{
    border: solid 1px midnightblue;
    border-radius: 50%;
    color: midnightblue;
    padding: 0px 3px 0px 3px;
  }
  .icono-menu{
    border: solid 1px midnightblue;
    border-radius: 4px;
    padding: 0px 1px 0px 1px;

    position: relative;
    left: 52px;
  }
  .logo-menu{
    width: 62px;
    margin-top: 10px;

  }
  .el-menu-vertical-demo:not(.el-menu--collapse) {
    width: 200px;
    min-height: 400px;
  }
}
</style>
