import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import Croppa from 'vue-croppa'
import Funciones from './Funciones'
import TabMenu from 'primevue/tabmenu';


import '~/plugins'
import '~/components'
// import '~/styles'

// import '~/filters'
Vue.component('Menu', TabMenu);
Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  Croppa,
  ...App
})
