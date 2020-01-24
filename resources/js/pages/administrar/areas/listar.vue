<template >
    <section>
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h3 class="mt-3">Listado de áreas</h3>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12 text-right">
                <el-tooltip placement="top">
                    <div slot="content">Crear Área</div>
                    <el-button type="primary" plain>
                        <i class="mdi mdi-plus f-20"></i>
                    </el-button>
                </el-tooltip>
            </div>
        </div>

        <el-collapse accordion>
            <el-collapse-item name="1">
                <template slot="title">
                    Consistency<i class="header-icon el-icon-information"></i>
                </template>
                <div>Consistent with real life: in line with the process and logic of real life, and comply with languages and habits that the users are used to;</div>
                <div>Consistent within interface: all elements should be consistent, such as: design style, icons and texts, position of elements, etc.</div>
            </el-collapse-item>
            <el-collapse-item title="Feedback" name="2">
                <div>Operation feedback: enable the users to clearly perceive their operations by style updates and interactive effects;</div>
                <div>Visual feedback: reflect current state by updating or rearranging elements of the page.</div>
            </el-collapse-item>
            <el-collapse-item title="Efficiency" name="3">
                <div>Simplify the process: keep operating process simple and intuitive;</div>
                <div>Definite and clear: enunciate your intentions clearly so that the users can quickly understand and make decisions;</div>
                <div>Easy to identify: the interface should be straightforward, which helps the users to identify and frees them from memorizing and recalling.</div>
            </el-collapse-item>
            <el-collapse-item title="Controllability" name="4">
                <div>Decision making: giving advices about operations is acceptable, but do not make decisions for the users;</div>
                <div>Controlled consequences: users should be granted the freedom to operate, including canceling, aborting or terminating current operation.</div>
            </el-collapse-item>
        </el-collapse>

    </section>
</template>

<script>
export default {
    data(){
        return{
            ruta:'/api/administrar/areas',
            areas:[],
        }
    },
    mounted(){
        this.listar_areas()
    },
    methods:{
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
</style>
