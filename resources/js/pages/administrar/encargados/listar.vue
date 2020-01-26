<template >
    <section>
        <h2 class="text-center">Listado de encargados</h2>

        <div class="row">
            <div class="col-12 text-right">
                <el-tooltip content="Registrar Encargado" placement="top">
                    <el-button type="primary" plain circle>
                        <i class="mdi mdi-plus-circle" @click="dialogFormVisible = true"></i>
                    </el-button>
                </el-tooltip>
            </div>

            
        </div>
    </section>
</template>

<script>
export default {
    data(){
        return{
            form:{},
            formLabelWidth: '120px',
            dialogFormVisible: false,
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
