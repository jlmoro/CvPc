<template>
    <section class="listar-proveedores">
        <h2 class="text-center mb-4">Listado de proveedores</h2>

        <div class="row w-10">
            <div class="col-12 text-left">
                <!-- <el-button type="primary" plain @click="showModal = true"> -->
                <el-button type="primary" plain @click="abir_modal_crear">
                    <i class="mdi mdi-plus"></i>
                    Nuevo Proveedor
                </el-button>
            </div>
        </div>

        <div class="row w-100 proveedores">
            <div v-for="(data,p) in 6" :key="p"  class="col-4">
                <div class="card mt-3" style="width: 18rem;">
                    <img class="card-img-top" src="img/epson.png" alt="Card image cap">
                    <hr>
                    <div class="card-body">
                        <h5 class="card-title text-center">Empresa {{p + 1}}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <hr/>
                        <div class="row w-100">
                            <div class="col-12 text-center">
                                <a href="#" class="btn btn-outline-primary">Historial pedidos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <modal ref="modalCrearProveedor" :ruta="ruta"/>

    </section>
</template>

<script>
export default {
    components: {
        Modal:()=> import('./componentes/modalCrearProveedor')
    },
    data(){
        return{
            ruta:'/api/proveedores',
            proveedores:[],
        }
    },
    mounted(){
        this.listar_proveedores()
    },
    methods:{
        async listar_proveedores(){
            try {
                const {data} = await axios(`${this.ruta}/listar-proveedores`)
                //notificacion si falla
                this.proveedores = data;

            } catch (e){
                console.warn(e);
            }
        },
        abir_modal_crear(){
            this.$refs.modalCrearProveedor.toggle();
        }
    }
}
</script>

<style lang="scss" scoped>

.listar-proveedores{
    .proveedores{

    }
}

</style>
