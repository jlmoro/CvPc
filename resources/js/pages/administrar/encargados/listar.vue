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
        <crear-encargado ref="modalCrearEncargado" :areas="lista_areas" :ruta="ruta" :roles="lista_roles"/>
    </section>
</template>

<script>
export default {
    components:{
        CrearEncargado:()=>import('./components/CrearEncargado')
    },
    data(){
        return{
            ruta:'/api/administrar/encargados',
            form:{},
            area:null,
            lista_areas:[],
            lista_roles:[],
            formLabelWidth: '120px',
            dialogFormVisible: false,
        }
    },
    mounted(){
        this.listar_areas()
    },
    methods:{
        crear_encargado(){
            this.$refs.modalCrearEncargado.toggle()
        },
        async listar_roles(){
            try {
                const {data} = await axios(`/api/select/${this.area}/listar-roles`)
                if (data.error) {
                    this.$Helper.notificacion('error','Error',data.error)
                    return
                }
                this.lista_roles = data

            } catch (e) {
                console.warn(e);
            }
        },
        async listar_areas(){
            try {
                const {data} = await axios(`/api/select/listar-areas`)
                if (data.error) {
                    this.$Helper.notificacion('error','Error',data.error)
                    return
                }
                this.lista_areas = data
            } catch (e) {
                console.warn(e);
            }
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
