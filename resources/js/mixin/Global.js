import {mapGetters} from 'vuex'
// import notificacion from './Funciones'

export default {
    methods:{

        notificacion(title, message, type = 'info', isHtml = true) {
            console.log('ingreso notificacion');
            Helper.notificacion(title, message, type, isHtml)
        },
    }
}
