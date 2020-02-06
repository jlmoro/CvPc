<template>
    <el-select v-model="value" filterable placeholder="Seleccione un área">
        <el-option
        v-for="item in options"
        :key="item.value"
        :label="item.label"
        :value="item.value">
        </el-option>
    </el-select>
</template>

<script>
export default {
    data(){
        return{
            options: [{
                value: 'Area1',
                label: 'Area1'
            }, {
                value: 'Area2',
                label: 'Area2'
            }, {
                value: 'Area3',
                label: 'Area3'
            }, {
                value: 'Area4',
                label: 'Area4'
            }, {
                value: 'Area5',
                label: 'Area5'
            }],
            value: ''
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
