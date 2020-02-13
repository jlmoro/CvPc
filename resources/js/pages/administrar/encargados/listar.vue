<template >
    <section class="listar-encargados">
        <h5 class="text-center">Listado de encargados</h5>

        <div class="row">
            <div class="col-12 text-right">
                <el-tooltip content="Registrar Encargado" placement="top">
                    <el-button type="primary" plain circle @click="crear_encargado">
                        <i class="mdi mdi-plus-circle" @click="dialogFormVisible = true"></i>
                    </el-button>
                </el-tooltip>
            </div>
        </div>
        <div class="row" >
            <div class="col-4 mt-4" v-for="(data,e) in encargados" :key="e">
                <div  class="card" style="width: 18rem;">
                    <img class="card-img-top" :src="`/storage/${data.foto}`" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title text-center ucfirst">{{data.nombre_completo}}</h5>
                        <div class="row w-100">
                            <div class="col-6">
                                <span class="mdi mdi-phone"></span>
                                <p>{{data.telefono}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <a href="#" class="btn btn-primary">Ver equipos</a>
                            </div>
                        </div>
                    </div>
                </div>
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
