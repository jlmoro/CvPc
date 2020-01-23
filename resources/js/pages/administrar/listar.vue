<template >
    <section>
        <!-- <h1>Aquí irá la lista de las tablas de administración</h1> -->

        <el-tabs v-model="activeName" @tab-click="handleClick">
            <el-tab-pane label="User" name="first">User</el-tab-pane>
            <el-tab-pane label="Config" name="second">Config</el-tab-pane>
            <el-tab-pane label="Role" name="third">Role</el-tab-pane>
            <el-tab-pane label="Task" name="fourth">Task</el-tab-pane>
        </el-tabs>
    </section>
</template>

<script>
export default {
    data(){
        return{
            activeName: 'first'
        }
    },
    methods: {
        handleClick(tab, event) {
            console.log(tab, event);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
