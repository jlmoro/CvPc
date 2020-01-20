<template>
    <section>
        <modal-formulario ref="modalCrearEvento" titulo="Crear Evento" size="md">
            <div class="row justify-content-center">
                <div class="col-6">
                    <label for="nombre_evento">Nombre del evento</label>
                    <input type="text" id="nombre_evento" >
                </div>
            </div>
        </modal-formulario>
    </section>
</template>

<script>
export default {
    data(){
        return{

        }
    },
    methods:{
        toggle(){
            console.log(this.$refs.modalCrearEvento);
            this.$refs.modalCrearEvento.toggle()
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
