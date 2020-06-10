<template>
  <div class="main-layout">
    <div class="row" style="margin-right: auto;">
      <div class="col seccion-menu">
        <menu-cvpc />
      </div>
      <div class="col">
        <navbar />
        <div class="row">
          <div class="col">
            <div class="container mt-4">
              <child />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'

export default {
  name: 'MainLayout',

  components: {
    Navbar,
    MenuCvpc:()=>import('~/components/MenuCvpc')
  },
  mounted(){
    if(this.$store.getters['auth/check']){
      this.$store.dispatch('menu/fetchMenu')
    }
  }
}
</script>
<style lang="scss" scoped>
  .main-layout{
    .seccion-menu{
      flex-grow: initial;
    }
  }
</style>
