import Vue from 'vue'
import Swal from 'sweetalert2'
import axios from 'axios'
// import ElementUI from 'element-ui';
// import 'element-ui/lib/theme-chalk/index.css';

let vue = new Vue;

export default class Helper {

  static notificacion(tipo='Info',titulo='',mensaje=''){
    vue.$notify({
      title: titulo,
      message: mensaje,
      type: tipo
    });
  }
}
