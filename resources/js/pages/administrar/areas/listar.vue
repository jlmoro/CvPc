<template >
    <section class="listar-areas">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h3 class="mt-3">Listado de áreas y roles</h3>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12 text-right">

                <el-popover
                placement="left"
                width="300"
                trigger="click"
                >
                <div class="row w-100">
                    <div class="col-12 text-center">
                        <h5>Crear Área</h5>
                    </div>
                    <div class="col-12 mt-1 mb-4">
                        <el-input
                        size="medium"
                        placeholder="Ingrese el área"
                        v-model="area"
                        @change="crear_area"
                        >
                        </el-input>
                    </div>
                </div>
                <!-- <el-tooltip content="Crear Área" placement="top"> -->
                    <el-button type="primary" size="small" round plain slot="reference">
                        <i class="mdi mdi-plus"></i>
                    </el-button>
                <!-- </el-tooltip> -->
                </el-popover>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-6">
                <el-collapse accordion>
                    <el-collapse-item :name="a" v-for="(data,a) in areas" :key="a">
                        <template slot="title">
                            <div class="row w-100 mt-5">
                                <div class="col-1 ml-3">
                                    <span>{{a + 1}}</span>
                                </div>
                                <div class="col-6">
                                    <p>{{data.area}}</p><i class="header-icon el-icon-information"></i>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="mdi mdi-pencil-circle ml-1"></i>

                                    <el-popover
                                    placement="top"
                                    width="160"
                                    v-model="visible"
                                    :reference="a"
                                    >
                                    <p>Are you sure to delete this?</p>
                                    <div style="text-align: right; margin: 0">
                                        <el-button size="mini" type="text" @click="visible = false">cancel</el-button>
                                        <el-button type="primary" size="mini" @click="visible = false">confirm</el-button>
                                    </div>

                                    <i slot="reference" class="mdi mdi-delete-circle ml-1"></i>

                                    </el-popover>

                                    <el-popover
                                    placement="right"
                                    width="400"
                                    trigger="click"
                                    :reference="a"
                                    >
                                    <div class="row w-100">
                                        <div class="col-12 text-center">
                                            <h5>Crear rol</h5>
                                        </div>
                                        <div class="col-12 mt-1 mb-4">
                                            <el-input
                                            size="medium"
                                            placeholder="Ingrese el rol"
                                            v-model="rol"
                                            @change="crear_rol(data)"
                                            >
                                            </el-input>
                                        </div>
                                    </div>
                                    <i slot="reference"  class="mdi mdi-plus-circle ml-3"></i>
                                </el-popover>

                                </div>
                            </div>
                        </template>

                        <ul v-for="(data2,r) in data.roles" :key="r" class="list-group ml-5 mr-5">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="row w-100 justify-content-center">
                                    <div class="col-1">
                                        <span>{{r + 1}}</span>
                                    </div>
                                    <div class="col-6">
                                        <p>{{data2.nombre_rol}}</p>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span class="badge badge-primary badge-pill">14</span>
                                        <i class="mdi mdi-pencil-circle ml-1"></i>
                                        <i class="mdi mdi-delete-circle ml-1"></i>
                                    </div>
                                </div>
                            </li>
                        </ul>
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
