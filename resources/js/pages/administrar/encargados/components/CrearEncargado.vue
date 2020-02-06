<template>
    <section class="crear-encargado">
        <modal  ref="modalEncargado">
            <div class="row" slot="header">
                <p class="">Crear encargado</p>
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
            <div class="row">
                <div class="col">

                </div>
            </div>
            <div class="row w-100">
                <div class="col-6">
                    <label for="tipo_documento">Tipo Documento</label>
                    <el-select v-model="value" placeholder="Seleccionar Tipo Doc">
                        <el-option
                        v-for="item in options"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                    </el-option>
                </el-select>
                </div>
                <div class="col-6">
                    <label for="documento">Documento</label>
                    <el-input id="documento" type="text" placeholder="Documento" v-model="form.documento" maxlength="30" show-word-limit >
                    </el-input>
                </div>
            </div>
            <div class="row w-100 mt-3">
                <div class="col-6">
                    <label for="fecha_de_nacimiento">Fecha de Nacimiento</label>

                    <el-date-picker
                        v-model="value"
                        type="datetime"
                        placeholder="Fecha de nacimiento">
                    </el-date-picker>
                </div>
                <div class="col-6">
                    <label for="telefono">Teléfono</label>
                    <el-input id="telefono" type="text" placeholder="Teléfono" v-model="form.telefono" >
                    </el-input>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="fecha_de_nacimiento">Área</label>
                    <!-- <select-areas /> -->
                </div>
                <div class="col-6">
                    <label for="fecha_de_nacimiento">Rol</label>
                    <!-- <select-roles/> -->
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
        Modal:()=> import('~/components/modales/modalB'),
        // SelectAreas:()=> import('~/components/modales/selectAreas'),
        // SelectRoles:()=> import('~/components/modales/selectRoles'),
    },
    data(){
        return{
            form:{
                foto:''
            },
            options: [{
                value: '1',
                label: 'C.C.'
            }, {
                value: '2',
                label: 'C.E.'
            }, {
                value: 'Option5',
                label: 'Option5'
            }],
            value: ''
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
.croppa-container{
    border-radius: 26px;
}
</style>
