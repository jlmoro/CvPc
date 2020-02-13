<template>
    <section>
        <h5 class="text-center">Listado de impresoras</h5>
        <div class="row w-100">
            <div class="col-12">
                <el-button type="primary" plain @click="crear_impresora">
                    <i class="mdi mdi-plus"></i>
                    Nueva Impresora
                </el-button>
            </div>
        </div>

        <div class="row w-100">

        </div>
        <modal-impresora ref="modalCrearImpresora"/>
    </section>
</template>

<script>
export default {
    components:{
        ModalImpresora:()=> import('./componentes/modalRegistrarImpresora')
    },
    data(){
        return{
            ruta:'/api/impresora',
            impresoras:[]
        }
    },
    mounted(){
        this.listar_impresoras()
    },
    methods:{
        crear_impresora(){
            this.$refs.modalCrearImpresora.toggle()
        },
        async listar_impresoras(){
            try {
                const {data} = await axios(`${this.ruta}/listar-impresoras`)
                if (data.error) {
                    this.$Helper.notificacion('warning','problema al listar',data.error)
                    return
                }
                this.impresoras = data

            } catch (e){
                console.warn(e);
            }
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
