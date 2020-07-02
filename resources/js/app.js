import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import Croppa from 'vue-croppa'
import moment from 'moment'
import Funciones from './Funciones'
// import filters from './filters'

import '~/plugins'
import '~/components'
import './filters'
// import '~/styles'

// import '~/filters'
Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  i18n,
  store,
  router,
  Croppa,
  ...App
})
