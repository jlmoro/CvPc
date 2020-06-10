import Vue from 'vue'
import moment from 'moment'

Vue.filter('letra-capital', function (value) {
  if (!value) return ''
  value = value.toString()
  return value.charAt(0).toUpperCase() + value.slice(1)
})

Vue.filter('formato_fecha', function (value,formato) {
  if (!value) return ''
  value = moment(value).format(formato)
  return value;
})
