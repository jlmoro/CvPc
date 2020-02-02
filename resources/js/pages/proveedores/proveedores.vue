<template>
    <section class="listar-proveedores mb-5">
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
            <div v-for="(data,p) in proveedores" :key="p"  class="col-4 card-padre">
                <div class="acciones-proveedor">
                    <span class="mdi mdi-pencil-circle-outline"></span>
                    <span class="mdi mdi-delete-circle-outline"></span>
                </div>
                <div class="card mt-3" style="width: 18rem;">
                    <img class="card-img-top img-proveedor" :src="`/storage/${data.logo}`" alt="Card image cap">
                    <hr>
                    <div class="card-body">
                        <h5 class="card-title text-center letra-capital">{{data.nombre_proveedor}}</h5>
                        <div class="card-text">
                            <div class="row">
                                <div class="col-2">
                                    <i class="mdi mdi-cellphone"></i>
                                </div>
                                <div class="col">
                                    <p>{{data.telefono}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <i class="mdi mdi-map-legend"></i>
                                </div>
                                <div class="col">
                                    <p>{{data.direccion}}</p>
                                </div>
                            </div>
                        </div>
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

        <modal ref="modalCrearProveedor" :ruta="ruta" @proveedor:creado="listar_proveedores"/>

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
    .img-proveedor{
        max-height: 141px;
    }
    .card-padre{
        &:hover{
            .acciones-proveedor{
                visibility: visible;
            }
        }
    }
    .acciones-proveedor{
        position: relative;
        text-align: right;
        right: 65px;
        top: 38px;
        z-index: 5;
        visibility: hidden;
        font-size: 28px;
        cursor: pointer;
    }
}

</style>
