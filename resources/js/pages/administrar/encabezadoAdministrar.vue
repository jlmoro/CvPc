<template >
    <section>
        <h3 class="mb-2 text-center">Listado de Administrables</h3>

        <el-tabs v-model="activeName" @tab-click="handleClick">
            <el-tab-pane
            v-for="(data,a) in administrar"
            :key="a"
            :label="data.nombre"
            :name="data.ruta"
            >
                <span slot="label"><i :class="data.icono"></i> {{data.nombre}}</span>
            </el-tab-pane>

            <router-view/>

        </el-tabs>
    </section>
</template>

<script>
export default {
    data(){
        return{
            activeName: 'first',
            administrar:[],
        }
    },
    mounted(){
        this.listar_administrables()
    },
    methods: {
        handleClick(tab, event) {
            console.log(tab, event);
            this.$router.push({
                name:tab.name
            })
        },
        async listar_administrables(){
            const {data} = await axios(`/api/administrar/listar-administrar`)
            this.administrar = data
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
