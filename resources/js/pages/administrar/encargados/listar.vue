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
        <crear-encargado ref="modalCrearEncargado" :areas="lista_areas" :ruta="ruta" @encargado:creado="listar_encargados"/>
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
            area:null,
            lista_areas:[],
            encargados:[],
            dialogFormVisible: false,
        }
    },
    mounted(){
        this.listar_areas()
        this.listar_encargados()
    },
    methods:{
        crear_encargado(){
            this.$refs.modalCrearEncargado.toggle()
        },
        async listar_encargados(){
            try {
                const {data} = await axios(`${this.ruta}/listar-encargados`)
                if (data.error) {
                    this.$Helper.notificacion('error','Error',data.error)
                    return
                }
                this.encargados = data

            } catch (e){
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
