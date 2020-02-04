<template>
    <modal ref="modalProveedor">
        <!-- <h3 slot="header" class="ml-auto ">Crear Proveedor</h3> -->
        <div slot="header" class="row">
            <div class="col-12">
                <h5>Crear Proveedor</h5>
            </div>
        </div>

        <div  slot="body" class="">
            <div class="row w-100 mb-5 mt-2">
                <div class="col-12 text-center">
                    <croppa
                    v-model="form.logo"
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
            <div class="row w-100 mb-1">
                <div class="col-12">
                    <label for="nombre-prov">Nombre Proveedor</label>
                    <el-input type="text" placeholder="Nombre proveedor" v-model="form.nombre_proveedor" maxlength="60" show-word-limit >
                    </el-input>
                </div>
            </div>
            <div class="row w-100 mt-1">
                <div class="col-6">
                    <label for="telefono">Teléfono</label>
                    <el-input type="text" placeholder="Teléfono" v-model="form.telefono" maxlength="30" show-word-limit >
                    </el-input>
                </div>
                <div class="col-6">
                    <label for="direccion">Dirección</label>
                    <el-input type="text" placeholder="Please input" v-model="form.direccion" maxlength="30" show-word-limit >
                    </el-input>
                </div>
            </div>
        </div>

        <div slot="footer" class="">
            <el-button type="success" plain @click="crear_proveedor">Guardar</el-button>
            <el-button type="danger" plain  @click="toggle">Cerrar</el-button>
        </div>
    </modal>
</template>

<script>
export default {
    components:{
        Modal:()=> import('~/components/modales/modalB')
    },
    props:['ruta'],
    data(){
        return{
            form:{
                logo:'',
            },
        }
    },
    methods:{
        async crear_proveedor(){
            this.form.logo = this.$refs.CroppaProveedor.img.src
            const {data} = await axios.post(`${this.ruta}/crear-proveedor`,this.form)
            this.form = {}
            this.notificacion('success','Guardado',data.mensaje)
            this.$refs.modalProveedor.toggle()
        },
        toggle(){
            this.$refs.modalProveedor.toggle()
        }
    }
}
</script>

<style lang="scss" scoped>
.croppa-container{
    border-radius: 26px;
}
.img-proveedor{
    max-width: 98px;
    max-height: 332px;
    border-radius: 50%;
}
</style>
