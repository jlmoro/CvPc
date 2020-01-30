<template>
    <modal ref="modalProveedor">
        <h3 slot="header" class="ml-auto ">Titulo de muestra</h3>

        <div  slot="body" class="">
            <div class="row w-100 mb-5 mt-2">
                <div class="col-12 text-center">
                    <img src="/img/epson.png" class="img-proveedor"/>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="nombre-prov">Nombre Porveedor</label>
                    <input v-model="form.nombre_proveedor" type="text" id="nombre-prov">
                </div>
                <div class="col-6">
                    <label for="telefono">Teléfono</label>
                    <input v-model="form.telefono" type="text" id="telefono">
                </div>
                <div class="col-6">
                    <label for="direccion">Dirección</label>
                    <input v-model="form.direccion" type="text" id="direccion">
                </div>
            </div>
        </div>

        <div slot="footer" class="">
            <button type="button" class="btn btn-outline-primary" @click="crear_proveedor">
                Guardar
            </button>
            <button type="button" class="btn btn-outline-danger" @click="toggle">
                Cerrar
            </button>
        </div>
    </modal>
</template>

<script>
export default {
    components:{
        Modal:()=> import('~/components/modales/modalB')
    },
    props:{
        ruta:{
            type:String,
            require:false
        }
    },
    data(){
        return{
            form:{},
        }
    },
    methods:{
        async crear_proveedor(){
            const {data} = await axios.post(`${this.ruta}/crear-proveedor`,this.form)
            this.$emit('proveedor:creado')
            this.$refs.modalProveedor.toggle()
        },
        toggle(){
            this.$refs.modalProveedor.toggle()
        }
    }
}
</script>

<style lang="scss" scoped>
.img-proveedor{
    max-width: 98px;
    max-height: 332px;
    border-radius: 50%;
}
</style>
