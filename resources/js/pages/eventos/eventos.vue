<template>
    <section>
        <h1>Lista de eventos </h1>
        <div class="row">
            <button @click="modal_crear_evento" type="button" name="button" class="btn btn-outline-primary">
                Crear Evento
            </button>
        </div>

        <div class="row">
            <el-button type="primary" plain>Primary</el-button>
        </div>

        <div class="row mt-4">

            <el-table :data="lista_eventos" style="width: 100%">
                <el-table-column fixed prop="date" label="Fecha" width="150"> </el-table-column>
                <el-table-column prop="name" label="Nombre" width="120"> </el-table-column>
                <el-table-column prop="state" label="Estado" width="120"> </el-table-column>
                <el-table-column prop="city" label="Ciudad" width="120"> </el-table-column>
                <el-table-column prop="address" label="Dirección" width="300"> </el-table-column>
                <el-table-column prop="zip" label="Código postal" width="120"> </el-table-column>
                <el-table-column
                fixed="right"
                label="Operaciones"
                width="120">
                <template slot-scope="scope">
                    <el-button @click="handleClick" type="text" size="small">Detalle</el-button>
                    <el-button type="text" size="small">Editar</el-button>
                </template>
                </el-table-column>
            </el-table>
        </div>

        <modal-crear-editar-evento ref="modalCrearEvento"/>
    </section>
</template>

<script>
export default {
    components:{
        // modalFormulario()
        modalCrearEditarEvento: () => import('./componentes/modalCrearEditarEvento')
    },
    data(){
        return{
            ruta:'/api/eventos',
            lista_eventos2:[],
            lista_eventos:[{
                date: '2016-05-03',
                name: 'Tom',
                state: 'California',
                city: 'Los Angeles',
                address: 'No. 189, Grove St, Los Angeles',
                zip: 'CA 90036',
                tag: 'Home'
            }, {
                date: '2016-05-02',
                name: 'Tom',
                state: 'California',
                city: 'Los Angeles',
                address: 'No. 189, Grove St, Los Angeles',
                zip: 'CA 90036',
                tag: 'Office'
            }],
        }
    },
    mounted(){
        this.listar_eventos()
    },
    methods:{
        handleClick() {
            console.log('click');
        },
        async listar_eventos(){
            try {
                const {data} = await axios(`${this.ruta}/listar-eventos`)
                if (data.error) {
                    console.error(data.error);
                    return
                }
                this.lista_eventos2 = data

            } catch (e){
                console.warn(e);
            }
        },
        modal_crear_evento(){
            this.$refs.modalCrearEvento.toggle()
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
