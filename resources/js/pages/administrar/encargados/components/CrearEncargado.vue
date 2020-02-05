<template>
    <section class="crear-encargado">
        <modal  ref="modalEncargado">
            <div class="row" slot="header">
                <p>Crear encargado</p>
            </div>
            <div class="" slot="body">
                <div class="row w-100 mb-5 mt-2">
                    <div class="col-12 text-center">
                        <croppa
                        v-model="form.foto"
                        placeholder="Seleccione una imagen"
                        :placeholder-font-size="14"
                        :width="200"
                        :height="191"
                        :show-remove-button="true"
                        :prevent-white-space="true"
                        ref="CroppaProveedor"
                        >
                    </croppa>
                </div>
            </div>
        </div>
        <div class="" slot="footer">
            <el-button type="success" plain @click="crear_encargado">Guardar</el-button>
            <el-button type="danger" plain  @click="toggle">Cerrar</el-button>
        </div>
    </modal>
</section>
</template>

<script>
export default {
    components:{
        Modal:()=> import('~/components/modales/modalB')
    },
    data(){
        return{
            form:{
                foto:''
            }
        }
    },
    methods:{
        async crear_encargado(){
            try {
                const {data} = await axios.post('')
            } catch (e) {

            }
        },
        toggle(){
            this.$refs.modalEncargado.toggle()
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
