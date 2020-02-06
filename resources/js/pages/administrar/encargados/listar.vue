<template >
    <section>
        <h2 class="text-center">Listado de encargados</h2>

        <div class="row">
            <div class="col-12 text-right">
                <el-tooltip content="Registrar Encargado" placement="top">
                    <el-button type="primary" plain circle @click="crear_encargado">
                        <i class="mdi mdi-plus-circle" @click="dialogFormVisible = true"></i>
                    </el-button>
                </el-tooltip>
            </div>
        </div>
        <crear-encargado ref="modalCrearEncargado"/>
    </section>
</template>

<script>
export default {
    components:{
        CrearEncargado:()=>import('./components/CrearEncargado')
    },
    data(){
        return{
            form:{},
            formLabelWidth: '120px',
            dialogFormVisible: false,
        }
    },
    methods:{
        crear_encargado(){
            this.$refs.modalCrearEncargado.toggle()
        },
    }
}
</script>

<style lang="scss" scoped>
</style>
