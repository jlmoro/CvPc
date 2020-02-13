<template>
    <section class="crear-impresora">
        <modal ref="ModalCrearImpresora">
            <div slot="header" class="row">
                <div class="col-12">
                    <h5>Crear Impresora</h5>
                </div>
            </div>
            <div slot="body" class="row">
                <div class="col-12">
                    contenido
                </div>
            </div>
            <div slot="footer" class="row">
                <div class="col-12">
                    <el-button type="danger" plain  @click="toggle">Cerrar</el-button>
                </div>
            </div>
        </modal>
    </section>
</template>

<script>
export default {
    components:{
        Modal:()=> import('~/components/modales/modalB')
    },
    data(){
        return{

        }
    },
    methods:{
        toggle(){
            this.$refs.ModalCrearImpresora.toggle()
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
