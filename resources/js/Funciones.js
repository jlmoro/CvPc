import Vue from 'vue'
// import Swal from 'sweetalert2'
import axios from 'axios'


static notificacion(tipo='Info',titulo='',mensaje=''){
    vue.$notify({
        title: titulo,
        message: mensaje,
        type: tipo
    });
}
