<template>
    <section>
        <div class="">
            <el-dialog
            title="Warning"
            :visible.sync="centerDialogVisible"
            width="30%"
            center>
            <span>It should be noted that the content will not be aligned in center by default</span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="centerDialogVisible = false">Cancel</el-button>
                <el-button type="primary" @click="centerDialogVisible = false">Confirm</el-button>
            </span>
            </el-dialog>
        </div>
    </section>
</template>

<script>
export default {
    name:'modalFormulario',
    // prop:{
    //     titulo:{
    //         type:String,
    //         default:'Crear'
    //     },
    //     size:{
    //         type:String,
    //         default:'md'
    //     },
    // },
    data(){
        return{
            centerDialogVisible: false
        }
    },
    mounted(){

    },
    methods:{
        toggle(){

        }

    }

}
</script>

<style lang="scss" scoped>
</style>
