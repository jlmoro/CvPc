<template>
  <section class="menu-principal">
    <div v-show="user" class="hidden" >
      <vs-sidebar background="#191970" textWhite absolute hover-expand reduce v-model="active" open>
      <template #logo>
        <!-- <img src="/img/logo_dark2.png" class="logo-menu" :class="menu" alt=""> -->
        <img src="/img/logo_dark2.png" alt="">
      </template>
      <!-- <div class=""> -->

        <vs-sidebar-group v-for="(data,m) in dataMenu" :key="m">
          <template #header>

            <vs-sidebar-item v-show="data.items.length == 0" :id="data.nombre" :to="data.ruta">
              <template #icon>
                <i :class='data.icono'></i>
              </template>
              <span class="letra-capital">{{data.nombre}}</span>
            </vs-sidebar-item>

            <vs-sidebar-item arrow v-show="data.items.length > 0">
              <template #icon>
                <i :class='data.icono'></i>
              </template>
              <span class="letra-capital">{{data.nombre}}</span>
            </vs-sidebar-item>
          </template>

          <vs-sidebar-item v-for="(data2,i) in data.items" :key="i" :id="data2.nombre" :to="data2.ruta">
            <template #icon>
              <i :class='data2.icono'></i>
            </template>
            <span class="letra-capital">{{data2.nombre}}</span>
          </vs-sidebar-item>
        </vs-sidebar-group>

        <template #footer>
          <vs-row justify="space-between">
            <vs-tooltip>
              <vs-avatar badge-color="danger" badge-position="top-right" class="salir">
                <i class='mdi mdi-logout' @click.prevent="logout" ></i>
              </vs-avatar>
              <template #tooltip>
                Cerrar Sesión
              </template>
            </vs-tooltip>

            <vs-tooltip>
              <vs-avatar class="mt-1">
                <img v-if="user.foto !== null" :src="`/storage/${user.foto}`" alt="">
                <img v-else :src="user.photo_url" alt="">
              </vs-avatar>
              <template #tooltip>
                {{user.name}}
              </template>
            </vs-tooltip>

          </vs-row>
        </template>

      <!-- </div> -->
    </vs-sidebar>
  </div>
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
      listandoMenu:'',
      active: 'home',
      activeSidebar: false,
    }
  },

  computed:{
    ...mapGetters({
      user: 'auth/user',
      dataMenu: 'menu/getMenu'
    })
  },
  mounted(){
    if(this.$store.getters['auth/check']){
      this.$store.dispatch('menu/fetchMenu')
      // this.listar_menu()
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

    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'welcome' })
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
  .mdi-logout{
    color: midnightblue !important;
  }
  .salir{
    &:hover{
      cursor: pointer;
    }
  }
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
    width: 50px;
    margin-top: 10px;
  }
  .logo-menu-expandido{
    width: 260px;
  }
  .el-menu-vertical-demo:not(.el-menu--collapse) {
    width: 200px;
    min-height: 400px;
  }

}
</style>
