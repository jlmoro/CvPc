<template >
    <section class="listar-areas">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h3 class="mt-3">Listado de áreas y roles</h3>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-6">

                <el-collapse v-for="(data,a) in areas" :key="a" accordion>
                    <el-collapse-item name="1">
                        <template slot="title">
                            <div class="row w-100">
                                <div class="col-1">
                                    <span>{{ a + 1}}</span>
                                </div>
                                <div class="col-6 ">
                                    {{data.area}}
                                    <!-- <i class="header-icon el-icon-information"></i> -->
                                </div>
                                <div class="col-5 text-right">
                                    <i class="mdi mdi-plus" @click.stop=""></i>
                                    <i class="mdi mdi-pencil" @click.stop=""></i>
                                    <i class="mdi mdi-delete" @click.stop=""></i>

                                </div>
                            </div>
                        </template>

                        <el-collapse v-for="(data2,r) in data.roles" :key="r">
                            <el-collapse-item name="1">
                                <template slot="title">
                                    {{data2.nombre_rol}}<i class="header-icon el-icon-information"></i>
                                    <i class="mdi mdi-pencil" @click.stop=""></i>
                                </template>

                            </el-collapse-item>
                        </el-collapse>

                    </el-collapse-item>
                </el-collapse>

            </div>
        </div>

    </section>
</template>

<script>
export default {
    data(){
        return{
            area:'',
            rol:'',
            ruta:'/api/administrar',
            areas:[],
            value: 100,
            visible: false,
        }
    },
    mounted(){
        this.listar_areas_roles()
    },
    methods:{
        async crear_rol(dato){
            try {
                let model ={
                    id_area: dato.id,
                    nombre_rol: this.rol
                }
                const {data} = await axios.post(`${this.ruta}/roles/crear-rol`,model)
                this.rol = ''
                this.listar_areas_roles()

            } catch (e){
                console.warn(e);
            }
        },
        async crear_area(){
            let model ={
                area: this.area
            }
            try {
                const {data} = await axios.post(`${this.ruta}/areas/crear-area`,model)
                this.area = ''
                this.listar_areas_roles()
            } catch (e) {
                console.warn(e);
            }
        },
        async listar_areas_roles(){
            try {
                const {data} = await axios(`${this.ruta}/areas/listar-areas`)
                this.areas = data
            } catch (e) {
                console.warn(e);
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.listar-areas{
    p{
        margin-bottom: 0px;
    }
}
</style>
