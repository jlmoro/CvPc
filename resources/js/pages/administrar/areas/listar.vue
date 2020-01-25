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
                trigger="click">
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
            <div class="col-5">
                <el-collapse accordion>
                    <el-collapse-item :name="a" v-for="(data,a) in areas" :key="a">
                        <template slot="title">
                            <p>{{data.area}}</p><i class="header-icon el-icon-information"></i>
                        </template>
                        <el-collapse accordion>
                        <el-collapse-item :name="b" v-for="(data,b) in 3" :key="b">
                            <template slot="title">
                                <p>rol {{b + 1}}</p><i class="header-icon el-icon-information"></i>
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
            ruta:'/api/administrar/areas',
            areas:[],
        }
    },
    mounted(){
        this.listar_areas()
    },
    methods:{
        async crear_area(){
            let model ={
                area: this.area
            }
            try {
                const {data} = await axios.post(`${this.ruta}/crear-area`,model)
                this.area = ''
                this.listar_areas()
            } catch (e) {
                console.warn(e);
            }
        },
        async listar_areas(){
            try {
                const {data} = await axios(`${this.ruta}/listar-areas`)
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
